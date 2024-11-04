<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SensorTypeReource;
use App\Http\Traits\HttpResponses;
use App\Models\SensorType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SensorTypeController extends Controller
{
    //
    use HttpResponses;
    public function index(): JsonResponse
    {
        return $this->success(SensorTypeReource::collection(SensorType::get()));
    }
}
