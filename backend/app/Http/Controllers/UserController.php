<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConstants;
use App\Helpers\ActivityLogs;
use App\Helpers\Module;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResources;
use App\Http\Traits\HttpResponses;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPrivileges;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;
    public function index(Request $request)
    {
        //
        $model = User::query();
        $list = Module::list_view($model,['roles'],$request->filter);
        return  UserResources::collection($list);
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
    public function store(UserRequest $request)
    {
        //
        $model = new User();
        foreach($request->all() as $key => $value){
            if($key != 'user_privileges' && $key != 'id'){
                $model->$key = $value;
            }
        }
        if($model->save()){
           $user_privileges_model = new UserPrivileges();
           foreach($request->user_privileges as $key => $value){
            if($key != 'id'){
                $user_privileges_model->$key = $value;
            }   
           }
           $user_privileges_model->user_id = $model->id;
           $user_privileges_model->save();
        }
        ActivityLogs::log($model->id,'users','create');
        return $this->success(new UserResources($model),class_basename($model).ResponseConstants::STORE);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        //
        $model = User::with('user_privileges')->where('id',$id)->first();
        return $this->success(new UserResources($model));
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
    public function update(UserRequest $request, User $user)
    {
        //
        $original = $user->replicate();
        foreach($request->all() as $key => $value){
            if($key != 'user_privileges'){
                $user->$key = $value;
            }
        }

        $user_privileges_model = UserPrivileges::where('user_id',$request->id)->first();
        foreach($request->user_privileges as $key => $value){
            if($key != 'id'){
                $user_privileges_model->$key = $value;
            }   
        }
        $user_privileges_model->save();
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

    public function get_role(): JsonResponse {
        $model = Role::all();
        return $this->success($model);
    }
}
