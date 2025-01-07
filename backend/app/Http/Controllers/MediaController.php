<?php

namespace App\Http\Controllers;

use App\Helpers\Module;
use App\Http\Resources\IncidentMediaResource;
use App\Http\Traits\HttpResponses;
use App\Models\IncidentMedia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;
    public function index(Request $request)
    {
        //
        return Storage::disk('public')->download($request->path);
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
        $date = Carbon::now();
        $file_path = $date->year."/".$date->month."/files";
        if($request->hasFile('files')){
            $incident_id = $request->incident_id;
            $files = $request->file('files');
            foreach($files as $file){
                if($path = $file->store($file_path,["disk" => "public"])){
                    $model = new IncidentMedia();
                    $filename = $file->getClientOriginalName();
                    $filename = explode(".",$filename)[0];
                    $extension = $file->getClientOriginalExtension();
                    $filetype = $file->getClientMimeType();
                    $model->incident_id = $incident_id;
                    $model->filename = $filename;
                    $model->extension = $extension;
                    $model->filetype = $filetype;
                    $model->path = $path;
                    $model->save();
                }
            }
        }
       return $this->success([],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,Request $request)
    {
        $list = Module::list_view_relation($request->module,[],$request->filter,$request->search,$id,"incident_id");
        return  IncidentMediaResource::collection($list);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $model = IncidentMedia::find($id);
        $path = $model->path;
        $model->delete();
        if($model){
            Storage::disk('public')->delete($path);
            return $this->success([],200);
        }
    }
}
