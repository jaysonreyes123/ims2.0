<?php

namespace App\Helpers;

use App\Constants\FieldConstants;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogs{
    public static function log($module = "",$module_item_id = "",$action,$old = null,$new = null){
        $module_id = Module::module_id($module);
        $description = "";
        if($action == "update"){
            $old = (array)$old;
            $get_changes = array_diff($new,$old);
            foreach($get_changes as $key => $val){
                if($key != "updated_at" && $key != "module" && $key != "created_at" && $key != "created_by" && $key != "updated_by"){
                    $module_fields = Module::get_field($module_id,$key);
                    $old_value = $old[$key];
                    $new_value = $val;
                    $label = $module_fields->label;
                    $description.= $label." changed <br>";
                    $description.="<b>From</b>: ".$old_value." <br> <b>To</b>: ".$new_value."<br> <br>";
                }   
            }
        }
        $model = new ActivityLog();
        $model->module_id   = $module_id;
        $model->module_item_id   = $module_item_id;
        $model->description = $description;
        $model->action      = $action;
        $model->user_id     = Auth::id();
        $model->save();
    }
}