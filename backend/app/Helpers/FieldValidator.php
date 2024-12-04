<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class FieldValidator{
    public static function validate($module,$field_name,$field_type,$field_value){
        $fields = null;
        if($field_type == "picklist"){
            $fields = self::picklist($field_name,$field_value);
        }
        else if($field_type == "time"){
            $fields = self::time($field_value);
        }
        else if($field_type == "date"){
            $fields = self::date($field_value);
        }
        else{
            $fields = $field_value;
        }
        return $fields;
    }
    public static function picklist($field_name,$field_value){
        $field = str_replace("_picklist","",$field_name);
        $field_value = ucfirst($field_value);
        $model_value = DB::table($field)->where('label',$field_value)->first();
        return $model_value->id ?? null;
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
}