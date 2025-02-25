<?php

namespace App\Http\Controllers;

use App\Helpers\Module;
use App\Http\Resources\WorkflowResource;
use App\Http\Traits\HttpResponses;
use App\Models\Workflow;
use App\Models\WorkflowCondition;
use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;
    public function index()
    {
        //
        return WorkflowResource::collection(Workflow::with('modules')->paginate(15));
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
        $model = new Workflow();
        $model->module = Module::module_id($request->module);
        $model->name = $request->name;
        $model->description = $request->description;
        $model->trigger = $request->trigger;
        $model->recurrence = $request->recurrence;
        $model->status = $request->status;
        if($model->save()){
            if(!empty($request->condition)){
                foreach($request->condition as $condition){
                    $condition_model = new WorkflowCondition();
                    $condition_model->workflow_id = $model->id;
                    $condition_model->field = $condition['field'];
                    $condition_model->operator = $condition['operator'];
                    $condition_model->value = $condition['value'];
                    $condition_model->type = $condition['type'];
                    $condition_model->save();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $model = Workflow::with('workflow_conditions')->find($id);
        return $this->success($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $model = Workflow::find($id);
        $model->module = Module::module_id($request->module);
        $model->name = $request->name;
        $model->description = $request->description;
        $model->trigger = $request->trigger;
        $model->recurrence = $request->recurrence;
        $model->status = $request->status;
        if($model->save()){
            WorkflowCondition::where('workflow_id',$id)->delete();
            if(!empty($request->condition)){
                foreach($request->condition as $condition){
                    $condition_model = new WorkflowCondition();
                    $condition_model->workflow_id = $model->id;
                    $condition_model->field = $condition['field'];
                    $condition_model->operator = $condition['operator'];
                    $condition_model->value = $condition['value'];
                    $condition_model->type = $condition['type'];
                    $condition_model->save();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
