<?php

namespace App\Http\Controllers\API\Display;

use App\Helpers\DisplayHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChartRequest;
use App\Http\Traits\HttpResponses;
use App\Models\Station;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapController extends Controller
{
    use HttpResponses;
    //
    public function index(ChartRequest $request): JsonResponse
    {
        $type = $request->type;
        $station_models = Station::with(['sensors' => function ($query) use ($type) {
            $query->where("sensor_type", Station::SENSOR_TYPE[$type]);
        }])->get();
        $output['type'] = "FeatureCollection";
        foreach ($station_models as $station_model) {
            if (isset($station_model->sensors[0])) {
                $value = 0;
                $data = array();


                foreach ($station_model->sensors as $sensors) {
                    $min = Station::THRESHOLD_MEASUREMENT[$sensors->sensor_type][0];
                    $time = Station::THRESHOLD_MEASUREMENT[$sensors->sensor_type][1];
                    $models = DisplayHelpers::data_without_datetime(Station::SENSOR_TYPE[$type], $station_model->sensors[0]->id, $min, $time);
                    if ($models != null) {
                        if (!$models->isEmpty()) {
                            $value = DisplayHelpers::decimal_places($models[0]->value, $station_model->sensors[0]->sensor_type);
                        }
                    }


                    if (!$sensors->warnings->isEmpty()) {
                        foreach ($sensors->warnings as $warnings) {
                            if ($warnings->is_check) {
                                if ($value >= $warnings->sensor_thresholds) {
                                    $table = "<table class='table-popup'>";
                                    $table .= "<tr><td colspan='2'>$station_model->name</td></tr>";
                                    $table .= "<tr><td>Level</td><td>$value</td></tr>";
                                    $table .= "<tr><td>Status</td><td>$warnings->status</td></tr>";
                                    $table .= "</table>";
                                    $data = array(
                                        "type" => "Feature",
                                        "properties" => array(
                                            "name" => $station_model->name,
                                            "data" => $value,
                                            "status" => $warnings->status,
                                            "color" => $warnings->color,
                                            "table" => $table

                                        ),

                                        "geometry" => array(
                                            "type" => "Point",
                                            "coordinates" => array_reverse(explode(",", $station_model->coordinates))
                                        )
                                    );
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            if (!empty($data)) {
                $output["features"][] = $data;
            }
        }

        return $this->success($output);
    }

    // public function map()
    // {
    //     $models = Station::with(['sensors' => function ($query) {
    //         $query->where('sensor_type', '<>', 3);
    //     }])->get();
    //     $output = array();
    //     $output['type'] = "geojson";
    //     foreach ($models as $model) {
    //         $data = array();
    //         $table = "";
    //         $table_array = array();
    //         $alert_array = array();
    //         foreach ($model->sensors as $sensors) {
    //             $value = 0;

    //             //echo $sensors;
    //             $sensor_type = $sensors->sensor_type;
    //             $sensor_id = $sensors->id;
    //             $type_min = Station::THRESHOLD_MEASUREMENT[$sensor_type][0];
    //             $time_type = Station::THRESHOLD_MEASUREMENT[$sensor_type][1];
    //             $data_models = DisplayHelpers::data_without_datetime($sensor_type, $sensor_id, $type_min, $time_type);
    //             if ($data_models != null) {
    //                 if (!$data_models->isEmpty()) {
    //                     $value = DisplayHelpers::decimal_places($data_models[0]->value, $sensor_type);
    //                 }
    //             }

    //             if (!$sensors->warnings->isEmpty()) {
    //                 foreach ($sensors->warnings as $warnings) {
    //                     $warning_array = array();
    //                     if ($warnings->is_check) {
    //                         if ($value >= $warnings->sensor_thresholds) {
    //                             $warning_array["sensor"] = $sensor_type;
    //                             $warning_array["status"] = $warnings->status;
    //                             $warning_array["color"] = $warnings->color;
    //                             $warning_array["value"] = $sensor_type == 1 ? $value . " mm" : $value . " m";
    //                             $alert_array[] = $warning_array;
    //                             break;
    //                         }
    //                     }
    //                 }
    //             }
    //         }



    //         if (!empty($alert_array)) {


    //             $table .= "<table class='table w-full text-sm text-center round text-gray-500 p-1 border p-0 m-0'><tr><th class='p-1' colspan='3'>" . $model->name . "</th></tr>";
    //             foreach ($alert_array as $keys => $values) {
    //                 $sensor_name = $values['sensor'] == 1 ? "Rain Fall" : "Water Level";
    //                 $table .= "<tr class='border'>";
    //                 $table .= "<td class='border p-1'>" . $sensor_name . "</td>";
    //                 $table .= "<td class='border p-1'><span class='badge rounded px-2.5 py-1 font-bold text-white' style='background:" . $values['color'] . "'>" . ucfirst($values['status']) . "</span></td>";
    //                 $table .= "<td class='border p-1'>" . $values['value'] . "</td>";
    //                 $table .= "</tr>";
    //             }
    //             $table .= "</table>";

    //             $data = array(
    //                 "type" => "Feature",
    //                 "properties" => array(
    //                     "table" => $table

    //                 ),
    //                 "geometry" => array(
    //                     "type" => "Point",
    //                     "coordinates" => array_reverse(explode(",", $model->coordinates))
    //                 )
    //             );
    //         }

    //         if (!empty($data)) {
    //             $output['data']['type'] =  "FeatureCollection";
    //             $output['data']['features'][] = $data;
    //         }
    //     }

    //     return $this->success($output);
    // }



    public function map()
    {
        $models = Station::with(['sensors' => function ($query) {
            $query->where('sensor_type', '<>', 3);
        }])->get();

        $output = array();
        $output['type'] = "geojson";

        foreach($models as $model){
            $data = array();
            $table = "";
            $color_ = "";
            $has_inactive = false;
            $table .= "<table class='table w-full text-sm text-center round text-gray-500 p-1 border p-0 m-0'><tr><th class='p-1' colspan='3'>" . $model->name . "</th></tr>";
            foreach($model->sensors as $sensors){
                $status  = $sensors->sensor_status_->status ?? 0;
                $sensor_type = $sensors->sensor_type;
                $sensor_name = $sensor_type == 1 ? "Rain Fall" : "Water Level";
                $status_ = "";
                if($status == 0){
                    $color = "gray";
                    $status_ = "Inactive";
                    $has_inactive = true;
                }
                else{
                    $color = "rgb(16, 176, 83)";
                    $status_ = "Active";            
                }
                $status__ = "<span class='badge text-white rounded p-1' style='background: $color;'>$status_</span>";
                $table .= "<tr class='border'>";
                $table .= "<td class='border p-1'>" . $sensor_name . "</td>";
                $table .= "<td class='border p-1'> $status__ </td>";
                $table .= "</tr>";
            }
            if($has_inactive){
                $color_ = "gray";
            }
            else{
                $color_ = "rgb(16, 176, 83)";
            }
            $data = array(
                "type" => "Feature",
                "properties" => array(
                    "table" => $table,
                    "station" => $model->name,
                    "color" => $color_
                ),
                "geometry" => array(
                    "type" => "Point",
                    "coordinates" => array_reverse(explode(",", $model->coordinates)),
                )
            );
            $output['data']['type'] =  "FeatureCollection";
            $output['data']['features'][] = $data;
        }
        return $this->success($output);

        // $output = array();
        // $output['type'] = "geojson";
        // foreach ($models as $model) {
        //     $data = array();
        //     $table = "";
        //     $table_array = array();
        //     $alert_array = array();
        //     foreach ($model->sensors as $sensors) {
        //         $value = 0;

        //         //echo $sensors;
        //         $sensor_type = $sensors->sensor_type;
        //         $sensor_id = $sensors->id;
        //         $type_min = Station::THRESHOLD_MEASUREMENT[$sensor_type][0];
        //         $time_type = Station::THRESHOLD_MEASUREMENT[$sensor_type][1];
        //         $data_models = DisplayHelpers::data_without_datetime($sensor_type, $sensor_id, $type_min, $time_type);
        //         if ($data_models != null) {
        //             if (!$data_models->isEmpty()) {
        //                 $value = DisplayHelpers::decimal_places($data_models[0]->value, $sensor_type);
        //             }
        //         }
                
        //         if (!$sensors->warnings->isEmpty()) {
        //             $has_warning = false;
        //             foreach ($sensors->warnings as $warnings) {
        //                 $warning_array = array();
        //                 if ($warnings->is_check) {
        //                     if ($value >= $warnings->sensor_thresholds) {
        //                         $warning_array["station"] = $model->id; 
        //                         $warning_array["sensor"] = $sensor_type;
        //                         $warning_array["status"] = $warnings->status;
        //                         $warning_array["color"] = $warnings->color;
        //                         $warning_array["value"] = $sensor_type == 1 ? $value . " mm" : $value . " m";
        //                         $warning_array["warning"] = true;
        //                         $alert_array[] = $warning_array;
        //                         $has_warning = true;
        //                         break;
        //                     }
        //                 }
        //             }
        //             if(!$has_warning){
        //                 $warning_array["warning"] = false;
        //                 $warning_array["station"] = $model->id; 
        //                 $warning_array["sensor"] = $sensor_type;
        //                 $warning_array["status"] = $sensors->sensor_status_->status ?? 0;
        //                 $alert_array[] = $warning_array;
        //             }
        //         }
        //     }


        //     $color = "green";
        //     if (!empty($alert_array)) {
        //         $table .= "<table class='table w-full text-sm text-center round text-gray-500 p-1 border p-0 m-0'><tr><th class='p-1' colspan='3'>" . $model->name . "</th></tr>";
        //         $station_warning = false;
        //         foreach ($alert_array as $keys => $values) {
                    
        //             $sensor_name = $values['sensor'] == 1 ? "Rain Fall" : "Water Level";
        //             if($values["warning"] == true){
        //                 $station_warning = true;
        //                 $table .= "<tr class='border'>";
        //                 $table .= "<td class='border p-1'>" . $sensor_name . "</td>";
        //                 $table .= "<td class='border p-1'><span class='badge rounded px-2.5 py-1 font-bold text-white' style='background:" . $values['color'] . "'>" . ucfirst($values['status']) . "</span></td>";
        //                 $table .= "<td class='border p-1'>" . $values['value'] . "</td>";
        //                 $table .= "</tr>";
        //             }
        //             if(!$station_warning){
        //                 if($values['status'] == 0){
        //                     $color = "gray";
        //                 }
        //                 $status = $values['status'] == 1 ? "<span class='badge text-white rounded p-1' style='background: rgb(16, 176, 83);'>active</span>" :"<span class='badge rounded text-white p-1 ' style='background:gray;'>inactive</span>"  ; 
        //                 $table .= "<tr class='border'>";
        //                 $table .= "<td class='border p-1'>" . $sensor_name . "</td>";
        //                 $table .= "<td class='border p-1'> $status </td>";
        //                 $table .= "</tr>";
        //             }
        //         }
        //         $table .= "</table>";

        //         $data = array(
        //             "type" => "Feature",
        //             "properties" => array(
        //                 "table" => $table,
        //                 "station" => $model->name,
        //                 "color" => $color

        //             ),
        //             "geometry" => array(
        //                 "type" => "Point",
        //                 "coordinates" => array_reverse(explode(",", $model->coordinates)),
        //             )
        //         );
        //     }
            
        //     // if (!empty($data)) {
        //     //     $sub_data = array("data" => array("coordinate" => array_reverse(explode(",", $model->coordinates)),"source" => $data,"table" => $table,"color" => $color));
        //     //     $output[] = $sub_data;
        //     // }
        //     if (!empty($data)) {
        //         $output['data']['type'] =  "FeatureCollection";
        //         $output['data']['features'][] = $data;
        //     }
        // }

        // return $this->success($output);
    }
}
