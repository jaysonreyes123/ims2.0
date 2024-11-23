<?php

namespace App\Http\Controllers\API;

use App\Events\RgEvent;
use App\Events\RGWLevent;
use App\Events\SingleChartEvent;
use App\Events\WlEvent;
use App\Http\Controllers\Controller;
use App\Models\LatestInterval;
use App\Models\Sensor;
use App\Models\SensorData;
use App\Models\SensorStatus;
use App\Models\Station;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    //
    public function sample(){

        // for($a = 1; $a <= 30; $a++){
        //     $station  = $a;
        //     $number = random_int(1,10);
        //     $timestamp = Carbon::now();
        //     $model = new SensorData;
        //     $model->sensor_id = $station;
        //     $model->value = $number;
        //     $model->timestamp = $timestamp;
        //     $model->save();
        // }   
        
        // $station  = 1;
        // $number = random_int(1,100);
        // $timestamp = Carbon::now();
        // $model = new SensorData;
        // $model->sensor_id = $station;
        // $model->value = $number;
        // $model->timestamp = $timestamp;
        // $model->save();

        // $trigger_event["wl"][1] = true;
        // $trigger_event["rg"][1] = true;
        // SingleChartEvent::dispatch($trigger_event);
    }
    public function insert_data()
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        try {
            $db2 = DB::connection('fms_mysql');
            $show_tables = $db2->select('SHOW TABLES');
            //sensor type
            $sensor_type = array(Station::RAIN_GAUGE, Station::WATER_LEVEL, Station::EXTERNAL_POWER_SUPPLY);

            $data_store = false;
            $counter = array();
            $type = array();
            $trigger_event = array();
            $trigger_event2 = array();
            $trigger_event_rg = false;
            $trigger_event_wl = false;

            foreach ($show_tables as $table) {
                $single_table = $table->Tables_in_FMSDB;

                //get the station model
                $station_model = Station::where('code', $single_table)->get();
                if (!$station_model->isEmpty()) {

                    $river_bed = 0;
                    $river_bed = (float) $station_model[0]->river_bed * 1000;

                    //check if latest interval exist
                    $latest_interval_timestamp = $station_model[0]->latest_intervals->timestamp ?? null;
                    $latest_interval_id = $station_model[0]->latest_intervals->id ?? null;

                    $station_id = $station_model[0]->id;
                    //where clause for fms database query
                    $where = "";
                    $where = $latest_interval_timestamp == null ? "" : " where `timestamp` > '$latest_interval_timestamp' ";
                    //get the from fms database
                    $fms_datas = $db2->select("SELECT * from $single_table $where ");
                    $timestamp = "";
                    //loop the fms data
                    if ($fms_datas != null) {
                        foreach ($fms_datas as $data) {

                            //get the id of sensor type
                            $sensor_type_id = Station::SENSOR_TYPE[$data->flag];
                            //query to check the station and sensor
                            $sensor_query_model = Sensor::where('station_id', $station_id)->where('sensor_type', $sensor_type_id)->get();

                            //if the sensor is empty in the table then create the sensor
                            if ($sensor_query_model->isEmpty()) {
                                //add the sensor and get the id
                                $sensor_model = Sensor::create([
                                    "station_id"    => $station_id,
                                    "sensor_type"   => $sensor_type_id
                                ]);
                                $sensor_id = $sensor_model->id;
                            } else {
                                //get the id of sensor 
                                $sensor_id = $sensor_query_model[0]->id;
                            }


                            //check if the sensor already exist in sensor status table
                            $sensor_status_model_ = SensorStatus::where('sensor_id', $sensor_id)->get();

                            //create if not exist
                            if ($sensor_status_model_->isEmpty()) {
                                //add sensor status record
                                SensorStatus::create([
                                    "sensor_id" => $sensor_id,
                                    "status"    => 0,
                                    "counter"   => 0
                                ]);
                            }

                            //if have sensor in queue
                            if (in_array($data->flag, $sensor_type)) {
                                //ttigger  to reload event 
                                if ($sensor_type_id == 1 && $data->value != 0) {
                                    $trigger_event["rg"][$station_id] = true;
                                    $trigger_event2[$sensor_type_id] = true;
                                    $trigger_event_rg = true;
                                } elseif ($sensor_type_id == 2 && $data->value != 0) {
                                    $trigger_event["wl"][$station_id] = true;
                                    $trigger_event2[$sensor_type_id] = true;
                                    $trigger_event_wl = true;
                                }

                                //sensor count automatic 0 if detect the data
                                $counter[$sensor_id] = 0;
                                //normal water level 1000
                                $normal_waterlevel = (int) Station::WL_LEVEL;
                                //save sensor data
                                $sensor_data_model = new SensorData();
                                $sensor_data_model->sensor_id = $sensor_id;

                                $value_flag = 0;
                                if (Station::WATER_LEVEL == $data->flag) {
                                    $value_flag = ($river_bed - $data->value) / 1000;
                                } else if (Station::RAIN_GAUGE == $data->flag) {
                                    $value_flag = $data->value / 10;
                                } else {
                                    $value_flag = $data->value;
                                }

                                $sensor_data_model->value     = $value_flag;
                                $sensor_data_model->timestamp = $data->timestamp;
                                $sensor_data_model->save();

                                $timestamp = $data->timestamp;
                            }
                        }
                    } else {
                        //if null the data get all sensor within the station to specif which sensor only have in station
                        $get_sensor_model_ = Sensor::where('station_id', $station_id)->get();
                        foreach ($get_sensor_model_ as $single_sensor) {
                            $counter[$single_sensor->id] = 1;
                        }
                    }
                    //create or update the latest interval model
                    if ($timestamp != "") {
                        $latest_interval_model = $latest_interval_id == null ? new LatestInterval() : LatestInterval::find($latest_interval_id);
                        $latest_interval_model->station_id = $station_id;
                        $latest_interval_model->timestamp = $timestamp;
                        $latest_interval_model->save();
                    }
                }
            }

            //update the sensor active 
            foreach ($counter as $sensor_id => $ctr) {
                $sensor_status_model = SensorStatus::where('sensor_id', $sensor_id)->first();
                $sensor_counter = $sensor_status_model->count;
                $sensor_status_id = $sensor_status_model->id;
                //if 0 value 
                if ($ctr == 0) {
                    $status = 1;
                    $value = 0;
                } else {
                    //check if the counter not exceed to 10 
                    if ($sensor_counter >= 10) {
                        $status = 0;
                    } else {
                        $status = 1;
                    }
                    $value = (int) $sensor_counter + $ctr;
                }
                //update sensor status
                $model = SensorStatus::find($sensor_status_id);
                $model->status = $status;
                $model->count = $value;
                $model->save();
            }

            // if($data_store){
            //     DataEvent::dispatch();
            // } 
            // if have new data trigger event functions
            $event = false;
            foreach ($trigger_event2 as $index => $val) {
                if ($index == 1 && $val == true) {
                    //RgEvent::dispatch();
                    $event = true;
                } elseif ($index == 2 && $val == true) {
                    //WlEvent::dispatch();
                    $event = true;
                }
            }

            if ($trigger_event_rg) {
                RgEvent::dispatch();
            }
            if ($trigger_event_wl) {
                WlEvent::dispatch();
            }
            if ($event) {
                RGWLevent::dispatch();
            }
            SingleChartEvent::dispatch($trigger_event);
            DB::disconnect('fms_mysql');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
