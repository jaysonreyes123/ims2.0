<?php

namespace App\Http\Controllers;

use App\Helpers\Module;
use App\Http\Resources\AcitvityLogResource;
use App\Http\Resources\LoginHistoryResource;
use App\Http\Traits\HttpResponses;
use App\Models\ActivityLog;
use App\Models\ActivitylogMain;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    //
    use HttpResponses;
    public function login_history(){
        $model = ActivityLog::orderByDesc('created_at')->paginate(20);
        return LoginHistoryResource::collection($model);
    }
    public function activity_logs($module,$module_id){
        $id = Module::module_id($module);
        $activity_model = ActivitylogMain::with(['activity_details','activity_relations'])
        ->where('itemid',$module_id)
        ->where('module',$id)
        ->orderByDesc('created_at')
        ->paginate(10);
        return AcitvityLogResource::collection($activity_model);    
    }
}
