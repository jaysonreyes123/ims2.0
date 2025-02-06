<?php

namespace App\Http\Controllers;

use App\Http\Traits\HttpResponses;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    use HttpResponses;
    public function get_report_chart(){
        $report_chart_model = Report::with('report_charts')->where('pin',1)->get();
        return $this->success($report_chart_model);
    }
}
