<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Resource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use stdClass;

class MapController extends Controller
{
    //
    public function index($model){
        $map_data = null;
        if($model == 'incidents'){
            $map_data = $this->incident();
        }
        else if($model == 'resources'){
            $map_data = $this->resources();
        }
        else if($model == 'heat_map'){
            $map_data = $this->heat_map();
        }
        return $map_data;
    }
    public function incident(){
        $model = Incident::with('incident_statuses')->where('deleted',0)->whereNotNull('coordinates')->get();
        $result = [];
        $result["type"] = "FeatureCollection";
        $result["features"] = array();
        foreach($model as $item){   
            $coordinates = explode(",",$item->coordinates);
            array_push(
                $result["features"],
                array(
                    "type" => "Feature",
                    "properties" => array(
                        "id"                => $item->id,
                        "incident_no"       => $item->incident_no,  
                        "status"            => $item->incident_statuses->name ?? "",
                        "location"          => $item->location
                    ),
                    "geometry" => array(
                        "type" => "Point",
                        "coordinates" => array(
                            (float) $coordinates[0], (float) $coordinates[1]
                        )
                    ),
                )
            );
        }
        return response($result,200)
                ->header('Content-type','application/json');
    }

    public function resources(){
        $model = Resource::with('resources_statuses')->where('deleted',0)->whereNotNull('coordinates')->get();
        $result = [];
        $result["type"] = "FeatureCollection";
        $result["features"] = array();
        foreach($model as $item){   
            $coordinates = explode(",",$item->coordinates);
            array_push(
                $result["features"],
                array(
                    "type" => "Feature",
                    "properties" => array(
                        "id"                => $item->id,
                        "name"              => $item->resources_name,
                        "type"            => $item->resources_types->name ?? "",
                        "status"            => $item->resources_statuses->name ?? "",
                    ),
                    "geometry" => array(
                        "type" => "Point",
                        "coordinates" => array(
                            (float) $coordinates[0], (float) $coordinates[1]
                        )
                    ),
                )
            );
        }
        return response($result,200)
                ->header('Content-type','application/json');
    }

    public function heat_map(){
        $model = Incident::where('deleted',0)->where('incident_statuses_picklist',3)->whereNotNull('coordinates')->get();
        $result = [];
        $result["type"] = "FeatureCollection";
        $result["features"] = array();
        foreach($model as $item){   
            $coordinates = explode(",",$item->coordinates);
            array_push(
                $result["features"],
                array(
                    "type" => "Feature",
                    "properties" => array(
                        "dbh"               => 10,
                        "id"                => $item->id,
                        "incident_no"       => $item->incident_no,  
                        "status"            => $item->incident_statuses->name ?? "",
                        "location"          => $item->location
                    ),
                    "geometry" => array(
                        "type" => "Point",
                        "coordinates" => array(
                            (float) $coordinates[0], (float) $coordinates[1]
                        )
                    ),
                )
            );
        }
        return response($result,200)
                ->header('Content-type','application/json');
    }
}
