<?php

namespace App\Http\Controllers;

use App\Http\Traits\HttpResponses;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogsController extends Controller
{
    //
    use HttpResponses;
    public function activity_logs($module,$module_id){
        return $this->success(
            ActivityLog::with(['users_'])->where('module_id',$module_id)
            ->where('module',$module)->get()
        );
    }
}
