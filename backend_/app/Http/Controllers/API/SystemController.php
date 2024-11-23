<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponses;
use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $model = System::find(1);
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $ext = $file->extension();
            $filepath = asset('images');
            $filename = $filepath."/".$file->getClientOriginalName();
            $file->move('images',$filename);
            $model->logo = $filename;
        }
        $model->site = $request->site;
        $model->save();
        return $this->success([$model]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return System::find(1);
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
