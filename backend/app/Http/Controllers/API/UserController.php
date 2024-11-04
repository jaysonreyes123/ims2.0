<?php

namespace App\Http\Controllers\API;

use App\Constants\ResponseConstants;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Traits\HttpResponses;
use App\Models\ActivityLogs;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    use HttpResponses;
    public function index(): JsonResponse
    {
        return $this->success(UserResource::collection(User::with(['roles_'])->get()));
    }
    public function store(Request $request): JsonResponse
    { 
        $request->validate([
            "name" => 'required',
            "email" => ['required', 'unique:users,email'],
            'password' => 'required',
        ]);
        $user =  User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "role" => $request->role
        ]);
        return $this->success(new UserResource($user), class_basename($user) . ResponseConstants::STORE);
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            "name" => 'required',
            "email" => ['required', "unique:users,email,$request->id,id"],
        ]);
        $user->update($request->only(['email', 'name', 'role']));
        return $this->success(new UserResource($user), class_basename($user) . ResponseConstants::UPDATE);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return $this->success($user, ResponseConstants::DESTROY);
    }


    public function activityLogs(): JsonResponse
    {
        return $this->success(UserResource::collection(ActivityLogs::with(['user'])->orderByDesc('updated_at')->get()));
    }

    public function checkPassword(Request $request){  

        $request->validate([
            "id" => 'required',
            "current_password" => 'required',
        ]);

        $user = User::find($request->get('id'));
        if($user && Hash::check($request->get('current_password'), $user->getAuthPassword())){
            return $this->success($user);
        }
        return $this->error($request->all(), "Current passwod does not match!");
    }


    public function changePassword(Request $request){ 

        $request->validate([
            "id" => 'required',
            "new_password" => 'required|min:6',
        ]);

        if(User::where('id', $request->get('id'))->update(['password' => Hash::make($request->get('new_password'))])){
            return $this->success($request);
        } 
        return $this->error($request->all(), "Change password failed. Try again.");
    }

}
