<?php

namespace App\Helpers;

use App\Constants\FieldConstants;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogs{
    public static function log($module_id = "",$module,$action,$old_model = null,$new_model = null){
        $description = "";
        if($action == "update"){
            foreach($new_model->getChanges() as $key => $val){
                if($key != "updated_at"){
                    $old_value = self::check_picklist($key,$old_model);
                    $new_value = self::check_picklist($key,$new_model);
                    $label = $key;
                    $description.= $label." changed <br>";
                    $description.="<b>From</b>: ".$old_value." <br> <b>To</b>: ".$new_value."<br> <br>";
                }   
            }
        }
        $model = new ActivityLog();
        $model->module_id   = $module_id;
        $model->module      = $module;
        $model->description = $description;
        $model->action      = $action;
        $model->user_id     = Auth::id();
        $model->save();
    }
    protected static function serialize_label($label){
        $parse_label = explode("_",$label);
        $labels = [];
        foreach($parse_label as $val){
            $labels[] = ucfirst(str_replace("picklist","",$val));
        }
        return implode(" ",$labels);
    }

    protected static function check_picklist($label,$model){
        $parse_label = explode("_",$label);
        if(end($parse_label) == "picklist"){
            $new_label = str_replace("_picklist","",$label);
            return $model->$new_label->label ?? "";
        }
        return $model->$label;
    }

}