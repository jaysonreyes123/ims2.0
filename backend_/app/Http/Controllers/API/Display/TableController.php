<?php

namespace App\Http\Controllers\API\Display;

use App\Helpers\DisplayHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\TableIntervalRequest;
use App\Http\Requests\TableRequest;
use App\Http\Traits\HttpResponses;
use App\Models\Sensor;
use App\Models\Station;
use App\Models\Warning;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TableController extends Controller
{
    //
    use HttpResponses;
    public $unit;
    public function __construct()
    {
        $this->unit = array("hrs" => "hour", "hr" => "hour", "min" => "minute", "mins" => "minute");
    }

    public function get_table_data(TableRequest $request)
    {

        $type   = $request->type;
        $columns = preg_replace("/[\n\r\t]/", "", json_encode($request->column));
        $columns = json_decode($columns, true);
        $date = $request->date ?? null;

        //get station with and filter the sensor per type
        $station_models = Station::with(['sensors' => function ($query) use ($type) {
            $query->where('sensor_type', Station::SENSOR_TYPE[$type]);
        }])->get();

        $col = array();


        $collection = array();
        //current time 5 minute

        $time =  $date == null ? date('Y-m-d H:i:00', strtotime("-" . Station::CURRENT_TIME . " minute")) : date('Y-m-d H:i', strtotime($date));


        //store to array the information of station and warning model
        foreach ($station_models as $station_model) {

            if (isset($station_model->sensors[0]->id)) {
                $sensor_id = $station_model->sensors[0]->id;

                $warning_models = Warning::where("sensor_id", $sensor_id)->get();
                $warning_column = array();
                foreach ($warning_models as $warning_model) {
                    $warning_column[$warning_model->status] = $warning_model->sensor_thresholds;
                }

                $collection[] = collect($station_model->makeHidden(['sensors']))
                    ->merge($warning_column)
                    ->merge(array("time" => $time, "sensor_id" => $sensor_id, "sensor_type" =>  $station_model->sensors[0]->sensor_type));
            }
        }

        $output = array();

        foreach ($collection as $collect) {
            $data = array();
            foreach ($columns as $column) {
                $parse_field = explode("_", $column["field"]);
                if (count($parse_field) >= 2) {
                    if (is_numeric($parse_field[0]) && array_key_exists($parse_field[1], $this->unit)) {
                        $time_number = (int) $parse_field[0];
                        $time_type = $this->unit[$parse_field[1]];
                        $value = 0;
                        $model = DisplayHelpers::data_without_datetime(Station::SENSOR_TYPE[$type], $collect["sensor_id"], $time_number, $time_type, $date);
                        if ($model != null) {
                            if (!$model->isEmpty()) {
                                $value = DisplayHelpers::decimal_places($model[0]->value, $collect["sensor_type"]);
                            }
                        }
                    }
                } else {
                    if ($column["field"] == "current") {
                        $value = 0.00;
                        $model = DisplayHelpers::data_without_datetime(Station::SENSOR_TYPE[$type], $collect["sensor_id"], Station::CURRENT_TIME, Station::CURRENT_TIME_TYPE, $date);
                        if ($model != null) {
                            if (!$model->isEmpty()) {
                                $value = DisplayHelpers::decimal_places($model[0]->value, $collect["sensor_type"]);
                            }
                        }
                    } else {
                        $value = $collect[$column["field"]] ?? '';
                    }
                }
                if ($value != '') {
                    $data[$column["field"]] = $value;
                    $data["sensor_id"] = $collect['sensor_id'];
                }
            }
            $output[] = $data;
        }
        return $this->success($output);
    }

    public function get_table_interval(TableRequest $request)
    {

        $type   = $request->type;
        $id     = $request->id;
        $date  =  $request->date ?? null;
        $columns = preg_replace("/[\n\r\t]/", "", json_encode($request->column));
        $columns = json_decode($columns, true);


        //get the current interval
        // $parse_field = explode("_",$columns[1]["field"]);
        // $time_number = $parse_field[0];
        // $time_type = $this->unit[$parse_field[1]];

        //get station with and filter the sensor per type
        $station_models = Station::with(['sensors' => function ($query) use ($type) {
            $query->where('sensor_type', Station::SENSOR_TYPE[$type]);
        }])->where("id", $id)->get();
        $output = array();
        foreach ($station_models as $station_model) {
            if (isset($station_model->sensors[0])) {
                $sum = 0;
                $data = array();
                $wl_value = array();
                $models = DisplayHelpers::data_with_datetime(Station::SENSOR_TYPE[$type], $station_model->sensors[0]->id, Station::CURRENT_TIME, Station::CURRENT_TIME_TYPE, $date,'DESC');
                //get all value
                if ($models != null) {
                    foreach ($models as $model) {
                        $value = DisplayHelpers::decimal_places($model->value, $station_model->sensors[0]->sensor_type);
                        $sum += $value;
                        $wl_value[] = $value;
                    }
                }
                if ($models != null) {
                    foreach ($models as $key => $model) {
                        $value = DisplayHelpers::decimal_places($model->value, $station_model->sensors[0]->sensor_type);
                        if (Station::WL == $station_model->sensors[0]->sensor_type) {
                            //hide the first row
                            if ($models->count() - 1 == $key) {
                                break;
                            }

                            $a = $value;
                            $b = (count($wl_value) - 1) == $key ? $wl_value[$key] : $wl_value[$key + 1];
                            $change = $a - $b;

                            $data["time"] = $model->date_time;
                            $data["current"] = $a;
                            $data['24_hrs'] = $change == 0 ? "-" : DisplayHelpers::decimal_places($change, $station_model->sensors[0]->sensor_type);
                        } else {

                            $data["time"] = $model->date_time;
                            $data["current"] = $value;
                            $data["24_hrs"] = DisplayHelpers::decimal_places($sum, $station_model->sensors[0]->sensor_type);
                            $sum -= $value;
                        }

                        $output[] = $data;
                    }
                }
            }
        }
        return $this->success($output);
    }

    public function get_table_for_warning()
    {

        $station_models = Station::with(['sensors' => function ($query) {
            $query->where("sensor_type", '<>', Station::EXP);
        }])->get();
        $output = array();
        foreach ($station_models as $station_model) {
            $subdata = array();
            $subdata["station_id"] = $station_model->id;
            $subdata["station_name"] = $station_model->name;
            if (isset($station_model->sensors)) {
                foreach ($station_model->sensors as $sensor) {
                    $value = 0;
                    $sensor_id = $sensor->id;
                    $min = Station::THRESHOLD_MEASUREMENT[$sensor->sensor_type][0];
                    $time = Station::THRESHOLD_MEASUREMENT[$sensor->sensor_type][1];
                    $data = DisplayHelpers::data_without_datetime($sensor->sensor_type, $sensor_id, $min, $time);
                    if ($data != null) {
                        if (!$data->isEmpty()) {
                            $value = DisplayHelpers::decimal_places($data[0]->value, $sensor->sensor_type);
                        }
                    }

                    $sensor_models = Sensor::find($sensor_id);
                    $bool = true;
                    foreach ($sensor_models->warnings as $warning) {
                        //check if the value is greater than on sensor thresholds
                        if ($value >= $warning->sensor_thresholds) {
                            if ($warning->is_check) {
                                $subdata[Station::RG == $sensor->sensor_type ? "rg_status" : "wl_status"] = $warning->status;
                                $subdata["color_" . $sensor->sensor_type] = $warning->color;
                                $bool = false;
                                break;
                            }
                        }
                    }
                    //if there is no sensor threshold trigger status declare to no rain and normal
                    if ($bool) {
                        // $subdata[Station::RG == $sensor->sensor_type ? "rg_status" : "wl_status" ] =
                        // Station::RG == $sensor->sensor_type ? "no Rain" : $sensor_models->warnings; 
                        if (Station::RG == $sensor->sensor_type) {
                            foreach ($sensor_models->warnings as $warnings) {
                                if ($warnings->status == 'no rain') {
                                    $subdata['rg_status'] = $warning->status;
                                    $subdata["color_" . $sensor->sensor_type] = $warnings->color;
                                }
                            }
                        } else {
                            foreach ($sensor_models->warnings as $warnings) {
                                if ($warnings->status == 'normal') {
                                    $subdata['wl_status'] = $warning->status;
                                    $subdata["color_" . $sensor->sensor_type] = $warnings->color;
                                }
                            }
                        }
                    }
                }
            }
            $output[] = $subdata;
        }
        return $this->success($output);
    }

    public function historical_table(Request $request){
        $station = $request->station;
        $date1 = $request->date1;
        $date2 = $request->date2;

        $rg = DisplayHelpers::historical($station,Station::RG,$date1,$date2);
        $wl = DisplayHelpers::historical($station,Station::WL,$date1,$date2);
        $rg_data = [];
        $rg_table = [];
        $rg_series = [];
        $rg_category=[];
        $wl_data = [];
        $wl_table = [];
        $wl_series = [];
        $wl_category=[];
        $wl_warning= [];
        $wl_color = [];
        $wl_status=[];
        $wl_sensor=[];
        $wl_option = [];
        $wl_color[] = "#09b350";
        foreach($rg->sensors[0]->sensor_data as $data){
            $rg_data[$data->timestamp_day][] = $data->value;
        }
        foreach($wl->sensors[0]->sensor_data as $data){
            $wl_data[$data->timestamp_day][] = $data->value;
        }
    
        foreach($wl->sensors[0]->warnings as $warning){
            $wl_color[] = $warning->color;
            $wl_status[$warning->status] = $warning->sensor_thresholds;
        }

        foreach($rg_data as $date => $value){
            $sub_data = [];
            $sum = 0;
            $date_ = "";
            $date_ = $date;
            $sum = $this->number_format(array_sum($rg_data[$date]));
            $rg_series[] = $sum;
            $rg_category[] = date('d M',strtotime($date_));
            $sub_data["date"] = $date_;
            $sub_data["24_hrs"] = $sum;
            $rg_table[] = $sub_data;
        }
        $wl_series = [];
        foreach($wl_data as $date => $value){
            
            $sub_data = [];
            $max = 0;
            $date_ = "";
            $date_ = $date;
            $max = $this->number_format(max($wl_data[$date]));
            $wl_category[] = date('d M',strtotime($date_));;
            $sub_data["date"] = $date_;
            $sub_data["min"] = $this->number_format(min($wl_data[$date]));
            $sub_data["max"] = $max;
            $sub_data["ave"] = $this->number_format(array_sum($wl_data[$date]) / count($wl_data[$date]));
            $wl_table[] = $sub_data;
            $wl_series["Max WL [m]"][] = $max;
            foreach($wl_status as $status => $threshold){
                $wl_series[$status][] = $threshold;
            }
        }
        foreach($wl_series as $name => $value){
            $sub_data = [];
            $sub_data["name"] = $name;
            $sub_data["data"] = $wl_series[$name];
            $wl_option["series"][] = $sub_data;
        }
        $wl_option["categories"] = $wl_category;
        $wl_option["colors"] = $wl_color;
        $result = [];   
        $result["rg"] = $rg_table;
        $result["wl"] = $wl_table;
        $result["rg_series"][] = ["name" => "Accumulated RF 24HRS [mm]", "data" => $rg_series];
        $result["rg_option"] = $rg_category;
        $result["wl_option"] = $wl_option;
        return $this->success($result);
    }

    public function number_format($value){
        return number_format($value,2,".",'');
    }
}
