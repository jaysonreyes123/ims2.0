<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConstants;
use App\Helpers\ActivityLogs;
use App\Helpers\Module;
use App\Http\Resources\ResponderResource;
use App\Http\Traits\HttpResponses;
use App\Models\Responder;
use App\Models\ResponderType;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;
    public function index(Request $request)
    {
        //
        $list = Module::list_view($request->module,[],$request->filter,$request->search);
        return  ResponderResource::collection($list);
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
        $model = new Responder();
        foreach($request->all() as $key => $value){
            $model->$key = $value;
        }
        $model->created_by = Auth::id();
        $model->save();
        ActivityLogs::log($model->id,'responders','create');
        return $this->success(new ResponderResource($model),class_basename($model).ResponseConstants::STORE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Responder $responder)
    {
        //
        return $this->success(new ResponderResource($responder));
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
    public function update(Request $request, Responder $responder) : JsonResponse
    {
        //
        $original = $responder->replicate();
        foreach($request->all() as $key => $value){
            $responder->$key = $value;
        }
        $responder->updated_at = Auth::id();
        $responder->save();
        ActivityLogs::log($responder->id,'resources','update',$original,$responder);
        return $this->success(new ResponderResource($responder),class_basename($responder).ResponseConstants::UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Responder $responder)
    {
        //
        $responder->deleted = 1;
        $responder->save();
        return $this->success([],class_basename($responder).ResponseConstants::DESTROY);
    }

    public function get_responder_type(){
        $model = ResponderType::all();
        return $this->success($model);
    }
}
