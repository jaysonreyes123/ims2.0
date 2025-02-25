<?php

namespace App\Helpers;

use App\Models\ActivitylogDetail;
use App\Models\ActivitylogMain;
use App\Models\ActivitylogRelation;
use App\Models\RelatedEntriesAll;
use App\Models\RelatedField;
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
            self::insert_related_entries($module_id,$itemid,$fields);
        }
        //update
        else if($status == 2){
            self::update($old_field,$fields,$activity_model->id);
            self::insert_related_entries($module_id,$itemid,$fields,$old_field);
        }
        //link
        else if($status == 4){
            self::link($activity_model->id,$related_module,$related_item_id);
            self::insert_related_entries_relation($module_id,$related_module,$itemid,$related_item_id);
        }
        else if($status == 5){
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
        $get_changes = self::get_changes($old,$new);
        foreach($get_changes as $field => $value){ 
            $create_model = new ActivitylogDetail();
            $create_model->activity_log_id = $activityid;
            $create_model->field = $field;
            $create_model->oldvalue = $value;
            $create_model->newvalue = $new[$field];
            $create_model->save();   
        }
    }
    public static function link($activityid,$related_module,$itemid){
        $link_model = new ActivitylogRelation();
        $link_model->activity_log_id = $activityid;
        $link_model->related_module = $related_module;
        $link_model->related_item_id = $itemid;
        $link_model->save();
    }
    public static function insert_related_entries_relation($module,$related_module,$module_id,$related_module_id){
        $related_entries_all = new RelatedEntriesAll();
        $related_entries_all->module = $module;
        $related_entries_all->related_module = $related_module;
        $related_entries_all->module_id = $module_id;
        $related_entries_all->related_id = $related_module_id;
        $related_entries_all->relation = 1;
        $related_entries_all->save();
    }
    public static function insert_related_entries($module,$module_id,$fields,$old_field = []){
        $related_fields = RelatedField::with('fields')->where('module',$module)->get();
        $get_changes = self::get_changes($old_field,$fields);
        if(!$related_fields->isEmpty()){
            foreach($related_fields as $related_field){
                $related_id = "";
                if(!empty($old_field)){
                    if(array_key_exists($related_field->fields->name,$get_changes)){
                        $related_id = $get_changes[$related_field->fields->name];
                    }
                }
                $related_module = $related_field->related_module;
                $related_entries_all = RelatedEntriesAll::where('module',$module)
                ->where('related_module',$related_module)
                ->where('module_id',$module_id)
                ->where('related_id',$related_id)
                ->where('relation',0)
                ->first();
                if(!$related_entries_all){
                    $related_entries_all = new RelatedEntriesAll();
                }
                if($fields[$related_field->fields->name] != ''){
                    $related_entries_all->module = $module;
                    $related_entries_all->related_module = $related_field->related_module;
                    $related_entries_all->module_id = $module_id;
                    $related_entries_all->related_id = $fields[$related_field->fields->name];
                    $related_entries_all->relation = 0;
                    $related_entries_all->save();
                }
            }
        }
    }
    public static function get_changes($old,$new){
        $old = (array) $old;
        $changes = [];
        foreach($old as $key => $value){
            if(!in_array($key,self::$not_allow)){
                if($new[$key] != $old[$key]){
                    $changes[$key] = $value;
                }
            }
        }
        return $changes;
    }
}