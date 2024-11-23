<?php

use App\Http\Controllers\IncidentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::post("login",[LoginController::class,'login']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user', [LoginController::class, 'details']);
    Route::get("logout",[LoginController::class,'logout']);

    //incident
    Route::apiResource('incidents',IncidentController::class);
    Route::get("incident_type",[IncidentController::class,'incident_type']);
    Route::get("incident_status",[IncidentController::class,'incident_status']);
    Route::get("incident_priority",[IncidentController::class,'incident_priority']);

    //resources
    Route::apiResource('resources',ResourceController::class);
    Route::get("resources_type",[ResourceController::class,'resources_type']);
    Route::get("resources_condition",[ResourceController::class,'resources_condition']);
    Route::get("resources_dispatch",[ResourceController::class,'resources_dispatch']);
    Route::get("resources_status",[ResourceController::class,'resources_status']);
});
