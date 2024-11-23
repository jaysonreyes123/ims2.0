<?php

namespace App\Http\Controllers\API\Display;

use App\Constants\ResponseConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChartRequest;
use App\Http\Resources\IncidentResources;
use App\Http\Traits\HttpResponses;
use App\Models\IncidentModel;
use App\Models\Sensor;
use App\Models\SensorStatus;
use App\Models\Station;
use App\Models\Warning;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WidgetController extends Controller
{
    //
    use HttpResponses;

    public $unit;
    public function __construct()
    {
        $this->unit = array("hrs" => "hour", "hr" => "hour", "min" => "minute", "mins" => "minute");
    }

    public function station_number()
    {
        $station_model = Station::where('status', 1)->get();
        return array('title' => '# of Station Active', 'count' => $station_model->count(), 'date' => date('F d, Y'));
    }

    public function sensor_status_count($label,$sensor_type){
        $sensors = Sensor::whereHas('sensor_status_',function($q){
            $q->where('status',1);
        })->where('sensor_type',$sensor_type)->get();
        return array('title' => $label, 'count' => $sensors->count(), 'date' => date('F d, Y'));
    }

    public function incident_number()
    {
        $incident_model = IncidentModel::get();
        return array('title' => '# of Alarm', 'count' => $incident_model->count(), 'date' => date('F d, Y'));
    }

    public function widget(): JsonResponse
    {
        $collect = collect([
            $this->sensor_status_count('Active Rainfall Sensors',Station::RG),
            $this->sensor_status_count('Active Water Level Sensors',Station::WL), 
            // $this->incident_number()
        ]);
        return $this->success($collect);
    }

    public function incident()
    {
    
        // return IncidentResources::collection(IncidentModel::with(['warnings'])->orderBy('updated_at', 'desc')->get());
        $output = [];
        $sensor_status =  SensorStatus::with('sensors')
        ->select("*",DB::raw('"sensor_status" as notification_type'))
        ->whereHas('sensors',function($q){
            //rainfall and water level sttatus
            $q->whereIn('sensor_type',[1,2]);
        })
        ->where('status',0)->get();
        $incident_model = IncidentModel::select("*",DB::raw('"warning" as notification_type'))->get();
        $collection = collect($sensor_status)->merge($incident_model)->sortByDesc('updated_at');

        foreach($collection as $key => $val){
            $sub_output = [];
            $status = $val->notification_type == "warning" ? $val->warnings->status : "Inactive";
            $value = $val->notification_type == "warning" ? $val->value : "Inactive";
            $sensor_type = $val->notification_type == "warning" ? $val->warnings->sensors->sensor_type : $val->sensors->sensor_type;
            $station = $val->notification_type == "warning" ? $val->warnings->sensors->stations->name : $val->sensors->stations->name;
            $color = $val->notification_type == "warning" ?  $val->warnings->color : "gray";
            $sub_output["id"] = $val->id;
            $sub_output["status"] = $status;
            $sub_output["value"] = $value;
            $sub_output['sensor_type'] = $sensor_type;
            $sub_output["station_name"] = $station;
            $sub_output["color"] = $color;
            $sub_output["time"] = date('F d Y h:i:s a',strtotime($val->updated_at));
            $sub_output["notification_type"] = $val->notification_type;
            $output[] = $sub_output;
        }
        return $this->success($output);
    }
    public function notification()
    {
        return IncidentResources::collection(IncidentModel::with(['warnings'])->where('status', 1)->orderBy('updated_at', 'desc')->get());
    }
    public function warning_list()
    {
        $warnings = Warning::get();
        $data = array();
        foreach ($warnings as $warning) {
            $data[$warning->sensor_id][] = array("status" => $warning->status, "color" => $warning->color);
        }
        return $this->success($data);
    }

    public function incidentStatus(Request $request)
    {
        $incident_model = IncidentModel::find($request->id);
        $incident_model->status = 0;
        $incident_model->save();
        return $this->success("Incident Status " . ResponseConstants::UPDATE);
    }
}
