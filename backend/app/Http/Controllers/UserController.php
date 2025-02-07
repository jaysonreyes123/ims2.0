<?php

namespace App\Http\Controllers;

use App\Http\Traits\HttpResponses;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $model = User::with('user_privileges')->find($id);
        return $this->success($model);
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

    public function assigned_to(){
        $model = User::all();
        $dropdown = [];
        foreach($model as $item){
            $sub_dropdown = [];
            $sub_dropdown['label'] = $item->name;
            $sub_dropdown['value'] = $item->id;
            $dropdown[] = $sub_dropdown;
        }
        return $dropdown;
    }
}
