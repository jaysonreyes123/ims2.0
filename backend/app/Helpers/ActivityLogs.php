<?php

namespace App\Helpers;

use App\Constants\FieldConstants;
use App\Models\ActivityLog;
use App\Models\ActivitylogDetail;
use App\Models\ActivitylogMain;
use App\Models\ActivitylogRelation;
use Illuminate\Support\Facades\Auth;

class ActivityLogs{
    protected static $not_allow = ['id','module','created_at','updated_at','created_by','updated_by','source','deleted'];
    public static function log($itemid,$module_id,$status,$fields = [],$old_field = [],$related_module = 0,$related_item_id = 0){
        $activity_model = new ActivitylogMain();
        $activity_model->itemid = $itemid;
        $activity_model->module = $module_id;
        $activity_model->status = $status;
        $activity_model->whodid = Auth::id();
        $activity_model->save();
        //create
        if($status == 1){
            self::create($fields,$activity_model->id);
        }
        //update
        else if($status == 2){
            self::update($old_field,$fields,$activity_model->id);
        }
        //link
        else if($status == 4 || $status == 5){
            self::link($activity_model->id,$related_module,$related_item_id);
        }
    }
    public static function create($fields,$activityid){
        foreach($fields as $field => $value){
            if(!in_array($field,self::$not_allow)){
                if($value != "" || $value != null){
                    $create_model = new ActivitylogDetail();
                    $create_model->activity_log_id = $activityid;
                    $create_model->field = $field;
                    $create_model->newvalue = $value;
                    $create_model->save();   
                }
            }
        }
    }
    public static function update($old,$new,$activityid){
        $old = (array) $old;
        $get_changes = array_diff($new,$old);
        foreach($get_changes as $field => $value){ 
            if(!in_array($field,self::$not_allow)){
                if($value != "" || $value != null){
                    $create_model = new ActivitylogDetail();
                    $create_model->activity_log_id = $activityid;
                    $create_model->field = $field;
                    $create_model->oldvalue = $old[$field];
                    $create_model->newvalue = $value;
                    $create_model->save();   
                }
            }
        }
    }
    public static function link($activityid,$related_module,$itemid){
        $link_model = new ActivitylogRelation();
        $link_model->activity_log_id = $activityid;
        $link_model->related_module = $related_module;
        $link_model->related_item_id = $itemid;
        $link_model->save();
    }
}