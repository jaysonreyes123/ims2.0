<?php

namespace App\Http\Controllers\API\Display;

use App\Helpers\ChartHelpers;
use App\Helpers\DisplayHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChartRequest;
use App\Http\Traits\HttpResponses;
use App\Models\Station;
use App\Models\Warning;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //
    use HttpResponses;

    public function get_chart_data(ChartRequest $request): JsonResponse
    {
        $type = $request->type;
        $return = array();
        $station_model = Station::with(['sensors' => function ($query) use ($type) {
            $query->where("sensor_type", Station::SENSOR_TYPE[$type]);
        }])->get();

        $datetime = array();
        foreach ($station_model as $station) {
            $data = array();

            $sub_data = array();
            if (isset($station->sensors[0])) {
                $chart_models = DisplayHelpers::data_with_datetime(Station::SENSOR_TYPE[$type], $station->sensors[0]->id, Station::CURRENT_TIME, Station::CURRENT_TIME_TYPE);
                if ($chart_models != null) {
                    foreach ($chart_models as $chart_model) {
                        $value = 0;
                        if ($chart_model->value) {
                            $value = DisplayHelpers::decimal_places($chart_model->value, $station->sensors[0]->sensor_type);
                        }
                        $data[] = $value;
                        $datetime[] = $chart_model->date_time;
                    }
                }

                $sub_data["name"] = $station->name;
                $sub_data["data"] = $data;


                $return['series'][] = $sub_data;
            } else {
                $sub_data["name"] = $station->name;
                $sub_data["data"] = array(0);
                $return['series'][] = $sub_data;
                $datetime[] = date('Y-m-d H:i');
            }
        }

        $output['chart'] = array(
            'toolbar' => array('show' => false)
        );
        $output['dataLabels'] = array(
            'enabled' => false
        );
        $output['stroke'] = array(
            "curve" => "smooth",
            "width" => 2
        );
        $output["yaxis"] = array(
            "labels" => array(
                "style" => array(
                    "colors" => "#CBD5E1",
                    "fontFamily" => "Inter"
                )
            )
        );
        $output["grid"] = array(
            "show" => true,
            "borderColor" => "#334155",
            "strokeDashArray" => 10,
            "position" => "back"
        );
        $output["xaxis"] = array(
            "type" => "datetime",
            "categories" => $datetime,
            "labels" => array(
                "style" => array(
                    "colors" => "#CBD5E1",
                    "fontFamily" => "Inter"
                ),
                "datetimeUTC" => false,
                "datetimeFormatter" => array(
                    "year" => 'yyyy',
                    'month' => 'yyyy-MM',
                    'day' => 'MM-dd',
                    "hour" => "H:mm",
                    "minute" => "H:mm"
                ),
            ),
            "axisBorder" => array(
                "show" => false
            ),
            "axisTicks" => array(
                "show" => false
            ),
        );
        $output["legend"] = array(
            "labels" => array(
                "colors" => "#CBD5E1"
            ),
            "fontFamily" => "Inter"
        );
        $output["tooltip"] = array(
            "x" => array(
                "format" => "yyyy-dd-MM HH:mm",
            ),
            "shared" => true
        );

        $return["option"] = $output;

        return $this->success($return);
    }

    public function get_single_chart(ChartRequest $request)
    {
        $type = $request->type;
        $id = $request->id;
        $max = 0;
        $river_bed = 0;
        $step = 5;
        $min = $request->minute ?? Station::CURRENT_TIME;
        $unit = $request->unit ?? Station::CURRENT_TIME_TYPE;
        $date = $request->date ?? null;
        $station_model = Station::with(['sensors' => function ($query) use ($type) {
            $query->where("sensor_type", Station::SENSOR_TYPE[$type]);
        }])->where('id', $id)->get();

        $date_ = date("Y-m-d");
        $interval_ = [];
        $no_date_ = [];
        for($a = 0; $a< 24;$a++){
            $interval_[] = $date_." ".str_pad($a,2,0,STR_PAD_LEFT).":00";
            $no_date_[] = 0;
        }
        $return = array();
        $datetime = array();
        $color = array('#008FFB');
        $stroke_width = array(2);
        foreach ($station_model as $station) {
            $river_bed = $station->river_bed;
            if (isset($station->sensors[0])) {
                $data = array();
                $warning_data = array();
                $sub_data = array();
                $chart_models = DisplayHelpers::data_with_datetime(Station::SENSOR_TYPE[$type], $station->sensors[0]->id, $min, $unit,$date);
                // sensor is water level
                if (Station::SENSOR_TYPE[$type] == 2) {
                    $warning_models = Warning::where('sensor_id', $station->sensors[0]->id)->get();
                    if (!$warning_models->isEmpty()) {
                        foreach ($warning_models as $warning_model) {
                            if ($warning_model->is_check) {
                                $color[] = $warning_model->color;
                                $stroke_width[] = 5;
                                $warning_data[$warning_model->status] = $warning_model->sensor_thresholds;
                            }
                        }
                    }
                } else {
                    $warning_models = Warning::where('sensor_id', $station->sensors[0]->id)->orderBy('sensor_thresholds','asc')->get();
                    if (!$warning_models->isEmpty()) {
                        foreach ($warning_models as $warning_model) {
                            
                            if ($warning_model->is_check) {
                                $max = (int) $warning_model->sensor_thresholds;
                                $color[] = $warning_model->color;
                                $stroke_width[] = 5;
                                $warning_data[$warning_model->status] = $warning_model->sensor_thresholds;
                            }
                        }
                    }
                }
                $sum = 0;
                if ($chart_models != null) {
                    if (!$chart_models->isEmpty()) {
                        foreach ($chart_models as $chart_model) {
                            $value = 0;
                            if ($chart_model->value) {
                                $value = DisplayHelpers::decimal_places($chart_model->value, $station->sensors[0]->sensor_type);
                            }
                            $data["current"][] = $value;
                            $datetime[] = $chart_model->date_time;
                            if (Station::SENSOR_TYPE[$type] == 1) {
                                // $data["daily sum"][] = number_format($sum += $value, 2, ".", "");
                                foreach ($warning_data as $key => $val) {
                                    $data[$key][] = $val;
                                }
                            } else {
                                foreach ($warning_data as $key => $val) {
                                    $data[$key][] = $val;
                                }
                            }
                        }
                    } else {
                        $data['no data'] = $no_date_;
                        $datetime = $interval_;
                    }
                } else {
                    $data['no data'] = $no_date_;
                    $datetime = $interval_;
                }



                foreach ($data as $index => $value) {
                    $sub_data["name"] = $index;
                    if (Station::SENSOR_TYPE[$type] == 1) {
                        $sub_data["data"] = $value;
                    } else {
                        $sub_data["data"] = $value;
                    }
                    $return['series'][] = $sub_data;
                }


                // if(!empty($warning_data)){
                //     $max = max($warning_data) * 2;
                // }
                // else{
                //     $max = max($sub_data['data']) * 2;
                // }

                if (Station::SENSOR_TYPE[$type] == 2) {
                    $max = $river_bed * 1;
                    $step = $river_bed;
                } else {
                    $max = $max * 2;
                }
            } else {
                $data['no data'][] = 0;
                $datetime[] = date('Y-m-d H:i');
                $return['series'][] = array("name" => "no data","data" => array(0));
            }
        }
        // $output['categories'] = $datetime;
        $output['colors'] = $color;
        $output['chart'] = array(
            'toolbar' => array('show' => false),

        );
        $output['dataLabels'] = array(
            'enabled' => false
        );
        $output['stroke'] = array(
            "curve" => "smooth",
            "width" => $stroke_width
        );
        $output["yaxis"] = array(
            "min" => 0,
            "tickAmount" => $step,
            "max" => $max,
            "labels" => array(
                "style" => array(
                    "colors" => "#727372",
                    "fontFamily" => "Inter",
                    "fontSize" => "14px"
                )
            )
        );
        $output["grid"] = array(
            "show" => true,
            "borderColor" => "#334155",
            "strokeDashArray" => 10,
            "position" => "back"
        );
        $output["xaxis"] = array(

            "type" => "datetime",
            "categories" => $datetime,
            "labels" => array(
                "style" => array(
                    "colors" => "#727372",
                    "fontFamily" => "Inter",
                    "fontSize" => "14px"
                ),
                "datetimeUTC" => false,
                "datetimeFormatter" => array(
                    "year" => 'yyyy',
                    'month' => 'yyyy-MM',
                    'day' => 'MM-dd',
                    "hour" => "H:mm",
                    "minute" => "H:mm"
                ),
            ),
            "axisBorder" => array(
                "show" => false
            ),
            "axisTicks" => array(
                "show" => false
            ),
        );
        $output["legend"] = array(
            "labels" => array(
                "colors" => "#CBD5E1"
            ),
            "fontFamily" => "Inter"
        );
        $output["tooltip"] = array(
            "x" => array(
                "format" => "yyyy-dd-MM HH:mm:00"
            ),
            "shared" => true,
        );

        $return["option"] = $output;
        return $this->success($return);
    }
}
