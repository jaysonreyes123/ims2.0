<?php

namespace App\Http\Controllers\Api\Auth;

use App\Constants\AuthConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Traits\HttpResponses;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginControllers extends Controller
{
    //
    //
    use HttpResponses;
    
    public function login(AuthRequest $request): JsonResponse
    {
        if (auth()->attempt($request->all())) {
            $expirationDate = Carbon::now()->addHours(24); 
            $user = auth()->user();
             /** @var User $user */
            $user->tokens()->delete();
            $success = $user->createToken('MyApp', ['expires_at' => $expirationDate])->plainTextToken;
            return $this->success(['token' => $success], AuthConstants::LOGIN);
        }

        return $this->error([], AuthConstants::VALIDATION);
    }

    public function logout(): JsonResponse
    { 
        $user = auth()->user(); 
        $user->tokens()->delete(); 
        return $this->success([], AuthConstants::LOGOUT);
    }
    public function details(): JsonResponse
    {
        $user = User::find(Auth::id());
        return $this->success($user, '');
    }
}
