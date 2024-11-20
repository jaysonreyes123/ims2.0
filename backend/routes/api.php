<?php
use App\Http\Controllers\Api\Auth\LoginControllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("login",[LoginControllers::class,'login']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user', [LoginControllers::class, 'details']);
    Route::get("logout",[LoginControllers::class,'logout']);
});
