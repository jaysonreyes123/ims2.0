<?php

namespace App\Helpers;

use App\Models\Sensor;
use App\Models\SensorData;
use App\Models\Station;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class DisplayHelpers{

    public static function data_without_datetime($sensor_type,$sensor_id,$time_number,$time_type,$date = null){

        if($date == null){
            $date2 = date('Y-m-d H:i:s');
            if($time_number == 24){
                $date1 = date('Y-m-d 00:00:00');
            }
            else{
                $date1 = date('Y-m-d H:i:s',strtotime("-$time_number $time_type"));
            }
            
        }   
        else{
            // $date2 = $date." ".date("H:i:s");
            // $date1 = date('Y-m-d H:i:s',strtotime("-$time_number $time_type",strtotime($date2)));
            //$date1 = $date." 00:00:00";
            $date2 = $date." 23:59:59";
            $date1 = date('Y-m-d H:i:s',strtotime("-$time_number $time_type",strtotime($date2)));
        }   
        $model  = null;
        switch($sensor_type){
            case 1:
                $model  = SensorData::select(DB::raw('sum(value) as value'))
                ->where("sensor_id",$sensor_id)
                ->whereBetween("timestamp",[$date1,$date2])
                ->groupBy('sensor_id')
                ->limit(1)
                ->get();
                break;
            case 2:
                $model = SensorData::select('value')
                ->where('id',function($query) use ($sensor_id,$date1,$date2){
                    $query->select(DB::raw('max(`id`)'))
                    ->from('sensor_data')
                    ->where("sensor_id",$sensor_id)
                    ->whereBetween("timestamp",[$date1,$date2]);
                })
                ->get();
                break;
        }
        return $model;
    }

    

    public static function data_with_datetime($type,$sensor_id,$time_number,$time_type,$date = null,$orderBy="ASC"){
        if($date == null){
            $date2 = date('Y-m-d H:i:s');
            $date1 = date('Y-m-d 00:00:00',strtotime("-$time_number $time_type",strtotime($date2)));
        }   
        else if($date == "last24"){
            $date2 = date('Y-m-d H:i:s');
            $date1 = date('Y-m-d H:i:s',strtotime("-1 day",strtotime($date2)));
        }
        else{
            $date1 = $date." 00:00:00";
            $date2 = date('Y-m-d 00:00:00',strtotime("+1 day",strtotime($date1)));
        }
        
        $format = $time_type == "minute" ? '%Y-%m-%d %H:%i' : '%Y-%m-%d %H:00';
        $model = null;
        switch($type){
            case 1:
                $model  = SensorData::select(DB::raw('sum(value) as value'),DB::raw("date_format(`timestamp` - interval $time_type(`timestamp`)%$time_number $time_type,'$format') as date_time"))
                 ->where("sensor_id",$sensor_id)
                 ->whereBetween("timestamp",[$date1,$date2])
                 ->groupBy('sensor_id','date_time')
                 ->orderBy('timestamp',$orderBy)
                 ->get();
                 break;
            case 2:
                $join1 = SensorData::select(
                    DB::raw('max(timestamp) as latest_time'),
                    DB::raw("date_format(`timestamp` - interval $time_type(`timestamp`)%$time_number $time_type,'$format') as date_time")
                )
                ->where("sensor_id",$sensor_id)
                ->whereBetween("timestamp",[$date1,$date2])
                ->groupBy('sensor_id','date_time');
               

        
                $model = SensorData::joinSub($join1,'test',function(JoinClause $join){
                    $join->on('sensor_data.timestamp','=','test.latest_time');
                })
                ->where('sensor_id',$sensor_id)
                ->whereBetween("timestamp",[$date1,$date2])
                ->orderBy('timestamp',$orderBy)
                ->groupBy('latest_time')
                ->get();
                break;
        }
        return $model;
    }

    

    public static function historical($station,$sensor_type,$date1,$date2){
        $model = Station::with(['sensors' => function($query) use ($date1,$date2,$sensor_type){
            $query->with(['warnings' => function($q){
                $q->where('is_check',1)
                ->orderBy('sensor_thresholds','asc');
            } ,'sensor_data' => function($q) use ($date1,$date2,$sensor_type){
                $q->select('*',DB::raw('date(timestamp) as timestamp_day'))
                ->whereDate('timestamp','>=',$date1)
                ->whereDate('timestamp','<=',$date2);
            }])->where('sensor_type',$sensor_type);
        }])->where('id',$station)->first(); 
        return $model;
    }

    // public static function historical_RG($station,$sensor_type,$date1,$date2){
    //     $model = Station::with(['sensors' => function($query) use ($date1,$date2,$sensor_type){
    //         $query->with(['sensor_data' => function($q) use ($date1,$date2,$sensor_type){
    //             $q->select('*',DB::raw('date(timestamp) as timestamp_day'))
    //             ->whereDate('timestamp','>=',$date1)
    //             ->whereDate('timestamp','<=',$date2);
    //         }])->where('sensor_type',$sensor_type);
    //     }])->where('id',$station)->first(); 
    //     return $model;
    // }
    // public static function historical_WL($station,$sensor_type,$date1,$date2){
    //     $model = Station::with(['sensors' => function($query) use ($date1,$date2,$sensor_type){
    //         $query->with(['sensor_data' => function($q) use ($date1,$date2,$sensor_type){
    //             $q->select('sensor_id',DB::raw('max(value) as timestamp_sum'),DB::raw('date(timestamp) as timestamp_day'))
    //             ->whereDate('timestamp','>=',$date1)
    //             ->whereDate('timestamp','<=',$date2);
    //         }])->where('sensor_type',$sensor_type);
    //     }])->where('id',$station)->first(); 
    //     return $model;
    // }


    public static function decimal_places($val,$sensor_type){
        if($sensor_type == Station::WATER_LEVEL){
            $val = number_format($val, 2, '.', '');
        }
        $val = number_format($val, 2, '.', '');
        return $val;
    }
}