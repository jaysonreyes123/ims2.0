<?php

use App\Http\Controllers\API\Auth\ForgotPasswordController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DataController;
use App\Http\Controllers\API\Display\ChartController;
use App\Http\Controllers\API\Display\MapController;
use App\Http\Controllers\API\Display\TableController;
use App\Http\Controllers\API\Display\WidgetController;
use App\Http\Controllers\API\EmailTemplateController;
use App\Http\Controllers\API\ExportController;
use App\Http\Controllers\API\NotificationSettingController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RecipientController;
use App\Http\Controllers\API\SensorController;
use App\Http\Controllers\API\SensorTypeController;
use App\Http\Controllers\API\StationController;
use App\Http\Controllers\API\SystemController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UserRoleController;
use App\Http\Controllers\API\WarningController;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\Table\Table;

Route::post('login', [LoginController::class, 'login']);
Route::post('register', RegisterController::class);
Route::post("/forgot-password", [ForgotPasswordController::class, 'forgot_password']);
Route::post("/reset-password", [ResetPasswordController::class, 'reset_password']);
//job
Route::get("insert_data", [DataController::class, 'insert_data']);
Route::get("check_warning", [WarningController::class, 'check_warning']);
Route::apiResource('system', SystemController::class);

Route::group(['middleware' => 'api.auth'], function () {
    Route::get('user', [LoginController::class, 'details']);
    Route::get('activity-logs', [UserController::class, 'activityLogs']);
    Route::get('logout', [LoginController::class, 'logout']);

    Route::apiResource('product', ProductController::class);
    Route::apiResource('category', CategoryController::class);

    Route::apiResource('station', StationController::class);
    Route::apiResource('sensor', SensorController::class);
    Route::get('show_sensor/{sensor_id}', [WarningController::class,'show_sensor']);
    Route::apiResource('warning', WarningController::class);
    Route::apiResource('notification', NotificationSettingController::class);
    Route::apiResource('recipient', RecipientController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('sensortype', SensorTypeController::class);
    Route::apiResource('user-role', UserRoleController::class);
    Route::apiResource('email-template',EmailTemplateController::class);

    //chart
    Route::post("chart/get_chart_data", [ChartController::class, 'get_chart_data']);
    Route::post("chart/get_single_chart", [ChartController::class, 'get_single_chart']);
    Route::post("map/get_map", [MapController::class, 'index']);
    Route::get("/map", [MapController::class, 'map']);
    //tabel
    Route::group(["prefix" => "table/"], function () {
        Route::post("get_table_data", [TableController::class, 'get_table_data']);
        Route::post("get_table_interval", [TableController::class, 'get_table_interval']);
        Route::get("get_table_for_warning", [TableController::class, 'get_table_for_warning']);
        Route::post("historical_table",[TableController::class,'historical_table']);
    });

    Route::get("widget", [WidgetController::class, 'widget']);
    Route::get("incident", [WidgetController::class, 'incident']);
    Route::get("alert_notification", [WidgetController::class, 'notification']);
    //widget
    // Route::group(["prefix" => "widget/"],function(){
    //     Route::get("station_number",[WidgetController::class,'station_number']);
    //     Route::get("incident_number",[WidgetController::class,'incident_number']);
    // });

    Route::get("warning_list", [WidgetController::class, 'warning_list']);
    Route::post("incidentStatus", [WidgetController::class, 'incidentStatus']);


    Route::post('checkPass', [UserController::class, 'checkPassword']); 
    Route::post('changePass', [UserController::class, 'changePassword']); 
});
//export
Route::get("/export/csv/{id}/{type}/{date}/{extension}", [ExportController::class, 'export']);
// Route::post("get_single",[ChartController::class,'get_single_chart']);
// Route::post("get_chart",[ChartController::class,'get_chart_data']);
// Route::post("/get_table_interval",[TableController::class,'get_table_interval']);
// Route::post("/get_table_data",[TableController::class,'get_table_data']);
// Route::get("/map",[MapController::class,'map']);

// Route::apiResource('station', StationController::class);