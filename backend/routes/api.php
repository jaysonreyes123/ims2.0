<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\RelatedController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use LDAP\Result;

Route::post("login",[LoginController::class,'login']);
Route::get("forgot-password/{email}",[AuthController::class,'forgot_password']);
Route::post("reset-password", [AuthController::class, 'reset_password']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get("logout",[LoginController::class,'logout']);
    Route::get('user_details', [LoginController::class, 'details']);

    //LOGS
    Route::get("activity_logs/{module}/{module_id}",[ActivityLogController::class,'activity_logs']);

    //dashboard
    Route::get("dashboard/get_report_charts",[DashboardController::class,'get_report_chart']);

    Route::get("module/fields/{module}",[ModuleController::class,'get_fields']);
    Route::get("module/get_dropdown/{field}",[ModuleController::class,'get_dropdown']);
    Route::get("module/generate/{module}",[ModuleController::class,'generate']);
    Route::get("module/edit/form/{module}/{option}",[ModuleController::class,'edit_form']);
    Route::get("module/get_summary/{module}",[ModuleController::class,'get_summary']);

    Route::apiResource("module",ModuleController::class);

    Route::get("list",[ListController::class,'index']);
    Route::get("list/columns",[ListController::class,'get_column']);
    Route::get("list/list_related_entries_filter",[ListController::class,'list_related_entries_filter']);

    //import
    Route::post("import/get_single_data",[ImportController::class,'get_single_data']);
    Route::post("import/save_import",[ImportController::class,'save_import']);

    //report
    Route::get("reports/get_columns/{id}",[ReportController::class,'get_column']);
    Route::post("reports/get_fields",[ReportController::class,"get_fields"]);
    Route::get("reports/get_chart/{id}",[ReportController::class,'get_chart']);

    Route::resource("reports",ReportController::class);
    Route::get("reports/pin/{id}/{pinvalue}",[ReportController::class,'pin']);
    Route::get("reports/generate/export/{type}/{id}",[ReportController::class,'generate']);

    //map api
    Route::get("map/{module}",[MapController::class,'index']);

    //related
    Route::get("get_related_menu/{module}",[RelatedController::class,'get_related_menu']);
    Route::get("get_related_list/{id}/{module}/{related_module}",[RelatedController::class,'related_list']);
    Route::post("save_relation",[RelatedController::class,'save']);
    Route::get("related/delete/{module}/{related_module}/{module_id}/{related_module_id}",[RelatedController::class,'delete']);
    Route::post("related/save_selected_row",[RelatedController::class,'save_selected_row']);
    Route::get("related/get_related_blocks/{module}/{related_module}",[RelatedController::class,'get_related_blocks']);

    //media
    Route::apiResource('media',MediaController::class);

    //user
    Route::apiResource('users',UserController::class);
    Route::get("dropdown/assigned_to",[UserController::class,'assigned_to']);


    //comment
    Route::post("comments/save",[CommentController::class,'save']);
    Route::post("comments/save_reply",[CommentController::class,'save_reply']);
    Route::get("comments/get_comments/{module}/{id}",[CommentController::class,'index']);
    Route::get("comments/get_comment_replies/{commentid}",[CommentController::class,'comment_reply_index']);
});