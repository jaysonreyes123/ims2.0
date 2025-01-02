<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConstants;
use App\Helpers\ActivityLogs;
use App\Helpers\Module;
use App\Http\Resources\CallLogsResources;
use App\Http\Traits\HttpResponses;
use App\Models\CallLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CallLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;
    public function index()
    {
        //
        return CallLogsResources::collection(CallLog::where('deleted',0)->paginate(Module::row_count()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $model = new CallLog();
        foreach($request->all() as $key => $value){
            if($key == 'assigned_team'){
                $model->$key = json_encode($value);
            }
            // else if($key == "time_of_incident"){
            //     if($value != null){
            //         $model->$key = $value['hours'].":".$value['minutes'].":".$value['seconds'];
            //     }
            // }
            else if($key == "date_of_incident"){
                $model->$key = $value == "" ? null : Carbon::parse($value)->format("Y-m-d");
            }
            else{
                $model->$key = $value;
            }
        }
        $model->save();
        ActivityLogs::log($model->id,'call_logs','create');
        return $this->success(new CallLogsResources($model),class_basename($model).ResponseConstants::STORE);
    }

    /**
     * Display the specified resource.
     */
    public function show(CallLog $callLog)
    {
        //
        return $this->success(new CallLogsResources($callLog));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CallLog $callLog)
    {
        //
        $original = $callLog->replicate();
        foreach($request->all() as $key => $value){
            if($key == 'assigned_team'){
                $callLog->$key = json_encode($value);
            }
            else{
                $callLog->$key = $value;
            }
        }
        $callLog->save();
        ActivityLogs::log($callLog->id,'call_logs','update',$original,$callLog);
        return $this->success(new CallLogsResources($callLog),class_basename($callLog).ResponseConstants::UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CallLog $callLog)
    {
        //
        $callLog->deleted = 1;
        $callLog->save();
        return $this->success([],class_basename($callLog).ResponseConstants::DESTROY);
        
    }
}
