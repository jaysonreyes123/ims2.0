<?php

namespace App\Http\Controllers;

use App\Helpers\Module;
use App\Http\Traits\HttpResponses;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    //
    use HttpResponses;
    public function activity_logs($module,$module_id){
        $id = Module::module_id($module);
        return $this->success(
            ActivityLog::with(['users_'])->where('module_id',$id)
            ->where('module_item_id',$module_id)->orderByDesc('created_at')->get()
        );
    }
}
