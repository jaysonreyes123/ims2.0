<?php

namespace App\Helpers;

use App\Models\Agency;
use App\Models\CallLog;
use App\Models\Contact;
use App\Models\Incident;
use App\Models\IncidentMedia;
use App\Models\PrePlan;
use App\Models\Resource;
use App\Models\Responder;
use App\Models\User;

class Module{
    public static function check_duplicate($module){
        $model = null;
        switch ($module) {
            case 'incidents':
                $model =  Incident::query() ;
                break;
            case 'resources':
                $model =  Resource::query() ;
                break;
            case 'contacts':
                $model =  Contact::query() ;
                break;
            case 'agencies':
                $model =  Agency::query() ;
                break;
            case 'responders':
                $model =  Responder::query() ;
                break;
            case 'preplans':
                $model =  PrePlan::query() ;
                break;
            case 'call_logs':
                $model =  CallLog::query() ;
                break;
            case 'users':
                $model =  User::query() ;
                break;
            case 'media':
                $model =  IncidentMedia::query() ;
                break;
            default:
                # code...
                break;
        }
        return $model;
    }
    public static function get_module($module){
        $model = null;
        switch ($module) {
            case 'incidents':
                $model = new Incident() ;
                break;
            case 'resources':
                $model = new Resource() ;
                break;
            case 'contacts':
                $model = new Contact() ;
                break;
            case 'agencies':
                $model = new Agency() ;
                break;
            case 'responders':
                $model = new Responder() ;
                break;
            case 'preplans':
                $model = new PrePlan() ;
                break;
            case 'users':
                $model = new User() ;
                break;
            default:

                # code...
                break;
        }
        return $model;
    }
    public  static function row_count(){
        return 15;
    }
    public static function filter($module,$relation,$filters){
        $model = self::check_duplicate($module);
        if(!empty($relation)){
            $model = $model->with($relation);
           }
            if(isset($filters)){
                foreach($filters as $filter){
                    if($filter['value'] != ""){
                        $model = $model->where($filter['field'],'like',$filter['value']."%");
                    }
                }
            }
           $model = $model->where('deleted',0);
           $model = $model->orderBy('updated_at','desc');
           $model = $model->paginate(self::row_count());
           return $model;
    }
    public static function search($module,$search){
        $model = self::check_duplicate($module);
        if($module == 'incidents'){
            $model = $model->with(['incident_types','incident_statuses']);
            $model = $model->where('incident_no','like',$search."%");
            $model = $model->orWhereHas('incident_types',function($query) use ($search){
                return $query->where('label','like',$search."%");
            }); 
        }
        else if($module == 'media'){

        }
        else if($module == 'resources'){
            $model = $model->where('resources_name','like',$search."%");
        }
        $model = $model->where('deleted', 0);
        $model = $model->orderBy('updated_at','desc');
        $model = $model->paginate(self::row_count());
        return $model;
    }
    public static function list_view($module,$relation = [],$filters,$search){
        if ($search != "") {
            return self::search($module, $search);
        } else {
            return self::filter($module, $relation, $filters);
        }
    }

    public static function search_relation($module,$search,$module_id,$module_filter){
        $model = self::check_duplicate($module);
        if($module == 'media'){
            if($search != ""){
                $model = $model->where('filename','like',$search."%");
            }
        }
        $model = $model->where($module_filter,$module_id);
        $model = $model->where('deleted', 0);
        $model = $model->orderBy('updated_at','desc');
        $model = $model->paginate(self::row_count());
        return $model;
    }

    public static function list_view_relation($module,$relation = [],$filters,$search,$module_id = "",$module_filter = ""){
        return self::search_relation($module, $search, $module_id,$module_filter);
    }
}