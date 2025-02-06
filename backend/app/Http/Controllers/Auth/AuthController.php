<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponses;
use App\Mail\ForgotPassword;
use App\Models\PasswordResetToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    //
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
}
