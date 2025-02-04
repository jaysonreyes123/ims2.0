<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConstants;
use App\Helpers\ActivityLogs;
use App\Helpers\Module;
use App\Http\Resources\IncidentResources;
use App\Http\Traits\HttpResponses;
use App\Models\Incident;
use App\Models\IncidentPriority;
use App\Models\IncidentStatus;
use App\Models\IncidentType;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;
    public function index(Request $request)
    {
        //
       $model = Incident::query();
       $list = Module::list_view($request->module,['incident_types','incident_statuses'],$request->filter,$request->search);
       return  IncidentResources::collection($list);
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
        $field = [];
        $model = new Incident();
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
        $model->created_by = Auth::id();
        $model->save();
        ActivityLogs::log($model->id,'incidents','create');
        return $this->success(new IncidentResources($model),class_basename($model).ResponseConstants::STORE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Incident $incident)
    {
        //
        return $this->success(new IncidentResources($incident));
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
    public function update(Request $request, Incident $incident) 
    {
        //
        $original_incident = $incident->replicate();
        foreach($request->all() as $key => $value){
            if($key == 'assigned_team'){
                $incident->$key = json_encode($value);
            }
            // else if($key == "time_of_incident"){
            //     if($value != null){
            //         $incident->$key = $value['hours'].":".$value['minutes'].":".$value['seconds'];
            //     }
            // }
            // else if($key == "date_of_incident"){
            //     $incident->$key = Carbon::parse($value)->format("Y-m-d");
            // }
            else{
                $incident->$key = $value;
            }
        }
        $incident->updated_by = Auth::id();
        $incident->save();
        ActivityLogs::log($incident->id,'incidents','update',$original_incident,$incident);
        return $this->success(new IncidentResources($incident),class_basename($incident).ResponseConstants::UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Incident $incident)
    {
        //
        $incident->deleted = 1;
        $incident->save();
        return $this->success([],class_basename($incident).ResponseConstants::DESTROY);
    }

    public function incident_type() :JsonResponse {
        $model = IncidentType::all();
        return $this->success($model);
    }
    public function incident_status() :JsonResponse {
        $model = IncidentStatus::all();
        return $this->success($model);
    }
    public function incident_priority() :JsonResponse {
        $model = IncidentPriority::all();
        return $this->success($model);
    }
}
