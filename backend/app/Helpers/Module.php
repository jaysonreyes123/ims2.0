<?php

namespace App\Helpers;

use App\Models\Agency;
use App\Models\CallLog;
use App\Models\Contact;
use App\Models\Incident;
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
    public static function list_view($module,$relation = [],$filters){
       if(!empty($relation)){
        $model = $module->with($relation);
       }
       else{
        $model = $module;
       }
        if(isset($filters)){
            foreach($filters as $filter){
                if($filter['value'] != ""){
                    $model = $model->where($filter['field'],'like',$filter['value']."%");
                }
            }
        }
       $model = $model->where('deleted',0);
       $model = $model->paginate(self::row_count());
       return $model;
    }
}