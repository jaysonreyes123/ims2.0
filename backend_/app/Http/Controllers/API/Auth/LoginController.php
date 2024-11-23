<?php

namespace App\Http\Controllers\API\Auth;

use App\Constants\AuthConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Traits\HttpResponses;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use HttpResponses;

    /**
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function login(AuthRequest $request): JsonResponse
    {
        if (auth()->attempt($request->all())) {
            $expirationDate = Carbon::now()->addHours(24); 
            $user = auth()->user();
             /** @var User $user */
            $user->tokens()->delete();
            $success = $user->createToken('MyApp', ['expires_at' => $expirationDate])->plainTextToken;
            $user::createActivityLogs($user->id, 'Login', AuthConstants::LOGIN);
            return $this->success(['token' => $success], AuthConstants::LOGIN);
        }

        return $this->error([], AuthConstants::VALIDATION);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    { 
        $user = auth()->user(); 
        $user::createActivityLogs($user->id, 'Logout', AuthConstants::LOGOUT);
        $user->tokens()->delete(); 
        return $this->success([], AuthConstants::LOGOUT);
    }

    /**
     * @return JsonResponse
     */
    public function details(): JsonResponse
    {
        $user = User::with('roles_')->find(Auth::id());
        return $this->success($user, '');
    }
}
