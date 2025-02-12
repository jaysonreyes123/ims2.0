<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogs;
use App\Helpers\Module;
use App\Http\Traits\HttpResponses;
use App\Models\Media;
use App\Models\RelatedEntry;
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
            $id = $request->id;
            $files = $request->file('files');
            foreach($files as $file){
                if($path = $file->store($file_path,["disk" => "public"])){
                    $model = new Media();
                    $filename = $file->getClientOriginalName();
                    $filename = explode(".",$filename)[0];
                    $extension = $file->getClientOriginalExtension();
                    $filetype = $file->getClientMimeType();
                    $model->filename = $filename;
                    $model->extension = $extension;
                    $model->filetype = $filetype;
                    $model->path = asset('storage')."/".$path;

                    $model->filetitle = $request->filetitle;
                    $model->note = $request->note;
                    $model->assigned_to = $request->assigned_to;
                    $model->save();

                    $module_id = Module::module_id($request->module);
                    $relation_module_id = Module::module_id('media');
                    $relation_entries = new RelatedEntry();
                    $relation_entries->module_id = $id;
                    $relation_entries->module = $module_id;
                    $relation_entries->related_id = $model->id;
                    $relation_entries->related_module = $relation_module_id;
                    $relation_entries->save();
                    ActivityLogs::log($id,$module_id,$status = 4,related_module:$relation_module_id,related_item_id:$model->id);
                }
            }
        }
       return $this->success([],200);
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
    }
}
