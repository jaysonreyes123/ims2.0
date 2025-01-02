<?php

namespace App\Http\Controllers;

use App\Http\Traits\HttpResponses;
use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    use HttpResponses;
    public function incident_by_type(){
        $model = Incident::select('incident_types_picklist', DB::raw('count(incident_types_picklist) as total'))
        ->with(['incident_types'])
        ->where('deleted',0)
        ->whereNotNull('incident_types_picklist')
        ->groupBy('incident_types_picklist')
        ->get()
        ->sortBy('incident_types.label');
        $output = [];
        $series_data = [];
        $categories_data = [];
        foreach($model as $item){
            $series_data[]     = $item->total;
            $categories_data[] = $item->incident_types->label;
        }
        $output['series'] = array(
            'name' => 'value',
            'data' => $series_data 
        );
        $output['categories'] = $categories_data;
        return $this->success($output);
    }

    public function incident_by_status(){
        $model = Incident::select('incident_statuses_picklist', DB::raw('count(incident_statuses_picklist) as total'))
        ->with(['incident_statuses'])
        ->where('deleted',0)
        ->whereNotNull('incident_statuses_picklist')
        ->groupBy('incident_statuses_picklist')
        ->get()
        ->sortBy('incident_statuses.label');
        $output = [];
        $series_data = [];
        $categories_data = [];
        foreach($model as $item){
            $series_data[]     = $item->total;
            $categories_data[] = $item->incident_statuses->label;
        }
        $output['series'] = array(
            'name' => 'value',
            'data' => $series_data 
        );
        $output['categories'] = $categories_data;
        return $this->success($output);
    }
}
