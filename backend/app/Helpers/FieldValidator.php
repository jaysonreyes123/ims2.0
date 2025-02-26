<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class FieldValidator{
    public static function validate($module,$field_name,$field_type,$field_value){
        $fields = null;
        if($field_type == "dropdown"){
            $fields = self::picklist($field_name,$field_value);
        }
        else if($field_type == "time"){
            $fields = self::time($field_value);
        }
        else if($field_type == "date"){
            $fields = self::date($field_value);
        }
        else if($field_type == "coordinates"){
            $fields = self::coordinates($field_value);
        }
        else{
            $fields = $field_value;
        }
        return $fields;
    }
    public static function picklist($field_name,$field_value){
        $model_value = DB::table($field_name)->where('label',$field_value)->first();
        return $model_value->label ?? null;
    }
    public static function time($field_value){
        $parse_time = explode(":",$field_value);
        $time = null;
        if(count($parse_time) == 2){
            $time = $field_value;
        }
        return $time;
    }
    public static function date($field_value){
        $date = date("Y-m-d",strtotime($field_value));
        $date_ = date("Y",strtotime($date));
        return $date_ == "1970" ? null : $date;
    }
    public static function coordinates($field_value){
        $parse = explode(",",$field_value);
        if(count($parse) != 2){
            return null;
        }
        $parse_lat = explode(".",$parse[0]);
        if($parse_lat >= -90 && $parse_lat <= 90){
            return $field_value;
        }
        else{
            return  implode(",",array_reverse($parse));
        }
    }
}