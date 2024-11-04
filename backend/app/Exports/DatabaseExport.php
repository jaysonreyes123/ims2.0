<?php

namespace App\Exports;

use App\Helpers\DisplayHelpers;
use App\Models\SensorData;
use App\Models\Station;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DatabaseExport implements FromView
{
    protected $id, $type, $date;
    public function __construct($id, $type, $date)
    {
        $this->id = $id;
        $this->type = $type;
        $this->date = $date;
    }

    public function view(): View
    {
        $filename = Station::SENSOR_TYPE[$this->type] == 1 ? "export.database_rf" : "export.database_wl";
        return view($filename, [
            'data' => $this->export_data()
        ]);
    }

    public function export_data()
    {
        $id = $this->id;
        $type = $this->type;
        $date = $this->date;
        $station_models = Station::with(['sensors' => function ($query) use ($type) {
            $query->where('sensor_type', Station::SENSOR_TYPE[$type]);
        }])->where("id", $id)->get();
        $output = array();
        foreach ($station_models as $station_model) {
            if (isset($station_model->sensors[0])) {
                $sum = 0;
                $data = array();
                $wl_value = array();
                $models = DisplayHelpers::data_with_datetime(Station::SENSOR_TYPE[$type], $station_model->sensors[0]->id, Station::CURRENT_TIME, Station::CURRENT_TIME_TYPE, $date,'DESC');
                //get all value
                if ($models != null) {
                    foreach ($models as $model) {
                        $value = DisplayHelpers::decimal_places($model->value, $station_model->sensors[0]->sensor_type);
                        $sum += $value;
                        $wl_value[] = $value;
                    }
                }
                if ($models != null) {
                    foreach ($models as $key => $model) {
                        $value = DisplayHelpers::decimal_places($model->value, $station_model->sensors[0]->sensor_type);
                        if (Station::WL == $station_model->sensors[0]->sensor_type) {
                            //hide the first row
                            if ($models->count() - 1 == $key) {
                                break;
                            }

                            $a = $value;
                            $b = (count($wl_value) - 1) == $key ? $wl_value[$key] : $wl_value[$key + 1];
                            $change = $a - $b;

                            $data["time"] = $model->date_time;
                            $data["current"] = $a;
                            $data['24_hrs'] = $change == 0 ? "-" : DisplayHelpers::decimal_places($change, $station_model->sensors[0]->sensor_type);
                        } else {

                            $data["time"] = $model->date_time;
                            $data["current"] = $value;
                            $data["24_hrs"] = DisplayHelpers::decimal_places($sum, $station_model->sensors[0]->sensor_type);
                            $sum -= $value;
                        }

                        $output[] = $data;
                    }
                }
            }
        }
        return $output;
    }
}
