<?php

namespace App\Helpers;

use App\Models\Field;
use App\Models\Module as ModelsModule;

class Module{
    public static function module_id($module){
        $model = ModelsModule::where("name",$module)->first();
        return $model->id;
    }
    public static function module_details($module){
        $model = ModelsModule::where("name",$module)->first();
        return $model;
    }
    public static function module_details_by_id($module_id){
        $model = ModelsModule::where("id",$module_id)->first();
        return $model;
    }
    public static function getChanges($old,$new){
        $old = (array)$old;
        $result=array_diff($new,$old);
        return $result;
    } 
    public static function get_field($module_id,$field_name){
        $model = Field::where("module_id",$module_id)
        ->where("name",$field_name)
        ->first();
        return $model;
    }  
}