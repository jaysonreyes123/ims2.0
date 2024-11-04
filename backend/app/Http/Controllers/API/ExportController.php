<?php

namespace App\Http\Controllers\API;

use App\Exports\DatabaseExport;
use App\Helpers\DisplayHelpers;
use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    //

    public function export($id, $type, $date, $extension)
    {
        $sensor_type = "";
        $format = "";
        switch (Station::SENSOR_TYPE[$type]) {
            case '1':
                $sensor_type = "Rainfall";
                break;
            case '2':
                $sensor_type = "Water Level";
                break;
        }
        switch ($extension) {
            case 'csv':
                $format = \Maatwebsite\Excel\Excel::CSV;
                break;
            case 'xlsx':
                $format = \Maatwebsite\Excel\Excel::XLSX;
                break;
        }
        $station = Station::find($id);
        $filename = $station->name . "-" . $sensor_type . "." . $extension;
        return Excel::download(new DatabaseExport($id, $type, $date), $filename, $format);
    }
}
