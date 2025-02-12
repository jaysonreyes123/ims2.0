<?php

namespace App\Helpers;

use App\Models\Field;
use App\Models\Incident;
use App\Models\Module;
use Illuminate\Support\Facades\DB;

class Generate{
    public static function id($module){
        $text = "";
        $maxid = 1;
        switch ($module) {
            case 'incidents':
                $maxid = Incident::max('id');
                $text = "INCIDENT";
                break;
            
            default:
                # code...
                break;
        }
        return $text.$maxid+1;
    }
    public static function get_field($module){
        $module_model = Field::where('table',$module)->where('type','generate')->first();
        return $module_model->name;
    }
    public static function get($module){
        $module_model = Module::where('name',$module)->whereNotNull('prefix')->first();
        $count = DB::table($module)->count();
        $output = [];
        $output["prefix"] = $module_model->prefix ?? "";
        $output["current_count"] = (int) $count+1; 
        return $output;
    }
}