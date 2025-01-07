<?php

namespace App\Http\Controllers;

use App\Constants\ResponseConstants;
use App\Helpers\ActivityLogs;
use App\Helpers\Module;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResources;
use App\Http\Traits\HttpResponses;
use App\Mail\EmailSender;
use App\Mail\ForgotPassword;
use App\Models\PasswordResetToken;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPrivileges;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;

    public function forgot_password($email)
    {

        $message = [];
        try {
            $email_checker = User::where('email',$email)->first();
            if(!$email_checker) {
                $status = 422;
                $message["message"] = "Email not existing";
            }
            else{
                $token = Str::random(64);
                Mail::to($email)->send(new ForgotPassword($token,$email));
                $model = PasswordResetToken::firstOrNew(['email' => $email]);
                $model->email = $email;
                $model->token = $token;
                $model->created_at = Carbon::now();
                $model->save();
                $status = 200;
            }
        } catch (\Throwable $th) {
            $status = 422;
            $message["message"] = $th->getMessage();

        }
        return response()->json($message,$status);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);
        $model = PasswordResetToken::where('token', $request->token)->first();
        if ($model == null) {
            return response()->json(["message" => "Invalid Token! Please try again"], 422);
        } else {
            User::where('email', $model->email)->update(['password' => Hash::make($request->password)]);
            $model->delete();
            return response()->json([], 200);
        }
    }

    public function index(Request $request)
    {
        //
        $list = Module::list_view($request->module,['roles'],$request->filter,$request->search);
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
