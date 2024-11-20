<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("login",[LoginController::class,'login']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user', [LoginController::class, 'details']);
    Route::get("logout",[LoginController::class,'logout']);
});
