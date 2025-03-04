<?php

namespace App\Http\Controllers;

use App\Http\Resources\SystemLogsResource;
use App\Http\Traits\HttpResponses;
use App\Models\ActivitylogMain;
use App\Models\Incident;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    use HttpResponses;
    public function get_report_chart(){
        $report_chart_model = Report::with('report_charts')->where('pin',1)->get();
        return $this->success($report_chart_model);
    }
    public function get_widget($module,$field = null,$operator = null,$value = null){
        $model = DB::table($module)->where("deleted",0);
        if($field != null && $operator != null && $value != null){
            $parse_value = explode(":",$value);
            $model->select($field);
            foreach($parse_value as $v){
                $model->where($field,$operator,$v);
            }
        }
        return $this->success($model->count());
    }
    public function incident_status(){

        $model = Incident::where("deleted",0)
        ->whereNotNull('incident_statuses')
        ->select("incident_statuses",DB::raw("count(id) as count"))
        ->groupBy('incident_statuses')
        ->orderBy('incident_statuses')
        ->get();
        $output = [];
        if($model->count() == 0){
            $output['label'][] = "No Data";
            $output['count'][] = 0;
        }
        else{
            foreach($model as $row){
                $output['label'][] = $row->incident_statuses;
                $output['count'][] = $row->count;
            }
        }
        return $this->success($output);
    }
    public function incident_trend_month(){
        $current_date = Carbon::now()->format("Y-m-d");
        //6month
        $date = Carbon::now()->subMonth(6)->format("Y-m-d");
        $model = Incident::whereDate('created_at',">=",$date)
        ->whereDate("created_at","<=",$current_date)
        ->where("deleted",0)
        ->select(DB::raw("DATE(created_at) as date"),DB::raw("count(id) as count"))
        ->groupBy('date')
        ->orderBy('date')
        ->get();
        $output = [];
        if($model->count() == 0){
            $output['label'][] = "No Data";
            $output['count'][] = 0;
        }
        else{
            foreach($model as $row){
                $output['label'][] = Carbon::parse($row->date)->format("F");
                $output['count'][] = $row->count;
            }
        }
        return $this->success($output);
    }
    public function get_systemlogs(){
        $model = ActivitylogMain::orderByDesc('created_at')->paginate(20);
        return SystemLogsResource::collection($model);
    }
}
