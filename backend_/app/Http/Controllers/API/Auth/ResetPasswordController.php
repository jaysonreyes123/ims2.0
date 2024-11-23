<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    // TODO
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
