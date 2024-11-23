<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\PasswordResetToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    // TODO
    public function forgot_password(Request $request)
    {
        $request->validate([
            "email" => 'required|email|exists:users'
        ]);
        $token = Str::random(64);
        $model = PasswordResetToken::firstOrNew(['email' => $request->email]);
        $model->email = $request->email;
        $model->token = $token;
        $model->created_at = Carbon::now();
        $model->save();
        Mail::to($request->email)->send(new ResetPassword($token, $request->email));
        return response()->json(["message" => "Email sent"], 200);
    }
}
