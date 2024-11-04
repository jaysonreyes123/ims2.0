<?php

namespace App\Http\Controllers\API;

use App\Constants\ResponseConstants;
use App\Events\IncidentEvent;
use App\Events\NotificationEvent;
use App\Helpers\DisplayHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WarningRequest;
use App\Http\Resources\IncidentResources;
use App\Http\Resources\WarningResource;
use App\Models\Warning;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Traits\HttpResponses;
use App\Jobs\SendMailJob;
use App\Models\IncidentModel;
use App\Models\NotificationSetting;
use App\Models\Recipient;
use App\Models\Sensor;
use App\Models\Station;
use App\Models\WarningStatus;
use Database\Seeders\WarningSeeder;

class WarningController extends Controller
{
    use HttpResponses;
    //
    public function index(): JsonResponse
    {
        return $this->success(WarningResource::collection(Warning::get()));
    }

    public function store(WarningRequest $request): JsonResponse
    {
        $warning =  Warning::create($request->all());
        return $this->success(new WarningResource($warning), class_basename($warning) . ResponseConstants::STORE);
    }

    public function show(Warning $warning): JsonResponse
    {
        return $this->success(new WarningResource($warning));
    }

    public function show_sensor($sensor_id){
        $model = Warning::where('sensor_id',$sensor_id)->pluck('status');
        $sensor_model = Sensor::find($sensor_id);
        $sensor_type = $sensor_model->sensor_type;
        $status_model = WarningStatus::where('sensor_type',$sensor_type)->whereNotIn('name',$model)->get();
        return $this->success($status_model);
    }

    public function update(WarningRequest $request, Warning $warning): JsonResponse
    {
        $warning->update($request->all());
        return $this->success(new WarningResource($warning), class_basename($warning) . ResponseConstants::UPDATE);
    }


    public function destroy($id)
    {
        //
        $warning = Warning::find($id);
        $warning->delete();
        return $this->success(WarningResource::collection(Warning::get()));
    }

    public function check_warning()
    {
        //get station and sensor type except External power supply
        $station_models = Station::with(['sensors' => function ($query) {
            $query->where("sensor_type", '<>', Station::EXP);
        }])->get();


        $event = false;
        $event2 = false;
        foreach ($station_models as $station_model) {
            //loop by single sensor
            foreach ($station_model->sensors as $sensor) {

                $value = 0;
                $sensor_id = $sensor->id;
                //get the unit time by sensor type
                $min = Station::THRESHOLD_MEASUREMENT[$sensor->sensor_type][0];
                $time = Station::THRESHOLD_MEASUREMENT[$sensor->sensor_type][1];

                $data = DisplayHelpers::data_without_datetime($sensor->sensor_type, $sensor_id, $min, $time);
                if ($data != null) {
                    if (!$data->isEmpty()) {
                        $value = DisplayHelpers::decimal_places($data[0]->value, $sensor->sensor_type);
                    }
                }
                //get the sensor by id
                $sensor_models = Sensor::with(['notifications'])->find($sensor_id);
                $bool = true;

                //get the warning and sensor related and notification
                foreach ($sensor_models->warnings as $warning) {



                    //check if the value is greater than on sensor thresholds
                    if ($value >= $warning->sensor_thresholds) {
                        $event2 = true;
                        $incident_status = false;
                        if (!$warning->is_check) {
                        } else {
                            //insert or update the incident model table
                            $incident_model = IncidentModel::where("sensor_id", $sensor_id)->get();
                            //trigger event when only new dat
                            if ($incident_model->isEmpty()) {
                                $event = true;
                            } else {
                                //check if change the warning id means status is change 
                                if ($incident_model[0]->warning_id != $warning->id) {
                                    $event = true;
                                    $incident_status = true;
                                }
                            }

                            $model = $incident_model->count() == 0 ? new IncidentModel() : IncidentModel::find($incident_model[0]->id);
                            $model->sensor_id = $sensor_id;
                            $model->warning_id = $warning->id;
                            $model->value = $value;
                            if ($incident_status) {
                                $model->status = 1;
                            }
                            $model->save();
                            $bool = false;
                            break;
                        }
                    }
                }

                //if there is no warning match on sensor threshold then check if exist the incident model if exist delete current incident model
                if ($bool) {
                    $incident_model = IncidentModel::where("sensor_id", $sensor_id)->get();
                    if ($incident_model->count() > 0) {
                        IncidentModel::where("sensor_id", $sensor_id)->delete();
                        //trigger event when has deleted
                        $event = true;
                    }
                }
            }
        }

        if ($event) {
            IncidentEvent::dispatch();
        }
        if ($event2) {
            NotificationEvent::dispatch();
        }
    }
}
