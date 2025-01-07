<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConstants;
use App\Helpers\ActivityLogs;
use App\Helpers\Module;
use App\Http\Resources\PrePlanResources;
use App\Http\Traits\HttpResponses;
use App\Models\PrePlan;
use App\Models\PrePlanClassification;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;
    public function index(Request $request)
    {
        //
        $list = Module::list_view($request->module,[],$request->filter,$request->search);
       return  PrePlanResources::collection($list);
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
        $model = new PrePlan();
        foreach($request->all() as $key => $value){
            $model->$key = $value;
        }
        $model->created_by = Auth::id();
        $model->save();
        ActivityLogs::log($model->id,'preplans','create');
        return $this->success(new PrePlanResources($model),class_basename($model).ResponseConstants::STORE);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        //
        $model = PrePlan::find($id);
        return $this->success(new PrePlanResources($model));
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
    public function update(Request $request, String $id) : JsonResponse
    {
        //
        $prePlan = PrePlan::find($id);
        $original = $prePlan->replicate();
        foreach($request->all() as $key => $value){
            $prePlan->$key = $value;
        }
        $prePlan->updated_by = Auth::id();
        $prePlan->save();
        ActivityLogs::log($prePlan->id,'preplans','update',$original,$prePlan);
        return $this->success(new PrePlanResources($prePlan),class_basename($prePlan).ResponseConstants::UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        //
        $prePlan = PrePlan::find($id);
        $prePlan->deleted = 1;
        $prePlan->save();
        return $this->success([],class_basename($prePlan).ResponseConstants::DESTROY);
    }

    public function get_preplan_classification(){
        $model = PrePlanClassification::all();
        return $this->success($model);
    }
}
