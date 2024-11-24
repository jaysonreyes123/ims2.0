<?php

namespace App\Helpers;

use App\Models\Incident;

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
}