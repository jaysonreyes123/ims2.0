<?php

use App\Helpers\Generate;
use App\Http\Controllers\ActivityLogsController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PrePlanController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ResponderController;
use App\Models\ResponderType;
use Illuminate\Support\Facades\Route;

Route::post("login",[LoginController::class,'login']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user', [LoginController::class, 'details']);
    Route::get("logout",[LoginController::class,'logout']);
    
    //user
    Route::get("get_assigned_to",[LoginController::class,'get_assigned_to']);

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

    //contacts
    Route::apiResource('contacts',ContactsController::class);
    Route::get("caller_types",[ContactsController::class,'get_caller_types']);
    Route::get("municipalities",[ContactsController::class,'get_municipalities']);
    Route::get("barangay",[ContactsController::class,'get_barangay']);

    //pre plan
    Route::apiResource('pre-plans',PrePlanController::class);
    Route::get("get_preplan_classification",[PrePlanController::class,'get_preplan_classification']);


    // agency
    Route::apiResource('agencies',AgencyController::class);

    //responders
    Route::apiResource('responders',ResponderController::class);
    Route::get("responder_type",[ResponderController::class,'get_responder_type']);

    //activity logs
    Route::get("activity_logs/{module}/{module_id}",[ActivityLogsController::class,'activity_logs']);


    //generate id
    Route::get("generate/id/{module}",function($module){
        return Generate::id($module);
    });

    //import
    Route::post("import/get_single_data",[ImportController::class,'get_single_data']);
    Route::post("import/save_import",[ImportController::class,'save_import']);

    //map api
    Route::get("map/{module}",[MapController::class,'index']);
});
