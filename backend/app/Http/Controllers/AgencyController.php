<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConstants;
use App\Helpers\ActivityLogs;
use App\Helpers\Module;
use App\Http\Resources\AgencyResources;
use App\Http\Traits\HttpResponses;
use App\Models\Agency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;
    public function index(Request $request)
    {
        //
        $list = Module::list_view($request->module,[],$request->filter,$request->search);
        return  AgencyResources::collection($list);
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
        $model = new Agency();
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
        ActivityLogs::log($model->id,'agencies','create');
        return $this->success(new AgencyResources($model),class_basename($model).ResponseConstants::STORE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Agency $agency)
    {
        //
        return $this->success(new AgencyResources($agency));
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
    public function update(Request $request, Agency $agency)
    {
        //
        $original = $agency->replicate();
        foreach($request->all() as $key => $value){
            if($key == 'assigned_team'){
                $agency->$key = json_encode($value);
            }
            else{
                $agency->$key = $value;
            }
        }
        $agency->updated_by = Auth::id();
        $agency->save();
        ActivityLogs::log($agency->id,'agencies','update',$original,$agency);
        return $this->success(new AgencyResources($agency),class_basename($agency).ResponseConstants::UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agency $agency)
    {
        //
        $agency->deleted = 1;
        $agency->save();
        return $this->success([],class_basename($agency).ResponseConstants::DESTROY);
    }
}
