<?php

namespace App\Helpers;

use App\Models\Agency;
use App\Models\Contact;
use App\Models\Incident;
use App\Models\PrePlan;
use App\Models\Resource;
use App\Models\Responder;

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
            case 'pre-plans':
                $model =  PrePlan::query() ;
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
            case 'pre-plans':
                $model = new PrePlan() ;
                break;
            default:

                # code...
                break;
        }
        return $model;
    }
}