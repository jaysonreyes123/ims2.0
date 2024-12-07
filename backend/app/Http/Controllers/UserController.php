<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConstants;
use App\Helpers\ActivityLogs;
use App\Http\Resources\UserResources;
use App\Http\Traits\HttpResponses;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;
    public function index()
    {
        //
        return UserResources::collection(User::where('deleted',0)->paginate(10));
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
        $model = new User();
        foreach($request->all() as $key => $value){
            $model->$key = $value;
        }
        $model->save();
        ActivityLogs::log($model->id,'users','create');
        return $this->success(new UserResources($model),class_basename($model).ResponseConstants::STORE);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return $this->success(new UserResources($user));
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
    public function update(Request $request, User $user)
    {
        //
        $original = $user->replicate();
        foreach($request->all() as $key => $value){
            $user->$key = $value;
        }
        $user->save();
        ActivityLogs::log($user->id,'users','update',$original,$user);
        return $this->success(new UserResources($user),class_basename($user).ResponseConstants::UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->deleted = 1;
        $user->save();
        return $this->success([],class_basename($user).ResponseConstants::DESTROY);
    }
    public function get_assigned_to() : JsonResponse {
        $model = User::where('id','<>',Auth::id())->get();
        return $this->success($model);
    }
}
