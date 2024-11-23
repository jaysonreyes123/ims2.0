<?php

namespace App\Http\Controllers\API;

use App\Constants\ResponseConstants;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserRoleResource;
use App\Http\Traits\HttpResponses;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserRoleController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        return $this->success(UserRoleResource::collection(UserRole::get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $role = UserRole::create($request->all());
        return $this->success(new UserRoleResource($role), class_basename($role) . ResponseConstants::STORE);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserRole $user_role): JsonResponse
    {
        //
        $user_role->update($request->all());
        return $this->success(new UserRoleResource($user_role), class_basename($user_role) . ResponseConstants::UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
