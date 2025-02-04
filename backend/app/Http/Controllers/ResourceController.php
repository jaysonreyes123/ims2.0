<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConstants;
use App\Helpers\ActivityLogs;
use App\Helpers\Module;
use App\Http\Resources\ResourceResources;
use App\Http\Traits\HttpResponses;
use App\Models\Resource;
use App\Models\ResourcesCategory;
use App\Models\ResourcesCondition;
use App\Models\ResourcesDispatcher;
use App\Models\ResourcesStatus;
use App\Models\ResourcesType;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        
        $list = Module::list_view($request->module,['resources_types','resources_statuses'],$request->filter,$request->search);
       return  ResourceResources::collection($list);
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
        $model = new Resource();
        foreach($request->all() as $key => $value){
            if($key == 'assigned_team'){
                $model->$key = json_encode($value);
            }
            else if($key == "date_acquired"){
                $model->$key = $value == "" ? null : Carbon::parse($value)->format("Y-m-d");
            }
            else{
                $model->$key = $value;
            }
        }
        $model->created_by = Auth::id();
        $model->save();
        ActivityLogs::log($model->id,'resources','create');
        return $this->success(new ResourceResources($model),class_basename($model).ResponseConstants::STORE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        //
        return $this->success(new ResourceResources($resource));
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
    public function update(Request $request, Resource $resource) : JsonResponse
    {
        //
        $original = $resource->replicate();
        foreach($request->all() as $key => $value){
            if($key == 'assigned_team'){
                $resource->$key = json_encode($value);
            }
            else if($key == "date_acquired"){
                $resource->$key = Carbon::parse($value)->format("Y-m-d");
            }
            else{
                $resource->$key = $value;
            }
        }
        $resource->updated_by = Auth::id();
        $resource->save();
        ActivityLogs::log($resource->id,'resources','update',$original,$resource);
        return $this->success(new ResourceResources($resource),class_basename($resource).ResponseConstants::UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        //
        $resource->deleted = 1;
        $resource->save();
        return $this->success([],class_basename($resource).ResponseConstants::DESTROY);
    }

    public function resources_type(){
        $model = ResourcesType::all();
        return $this->success($model);
    }
    public function resources_condition(){
        $model = ResourcesCondition::all();
        return $this->success($model);
    }
    public function resources_dispatch(){
        $model = ResourcesDispatcher::all();
        return $this->success($model);
    }
    public function resources_status(){
        $model = ResourcesStatus::all();
        return $this->success($model);
    }
    public function resources_categories(){
        $model = ResourcesCategory::all();
        return $this->success($model);
    }
}
