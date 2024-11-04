<?php

namespace App\Http\Controllers\API;

use App\Constants\ResponseConstants;
use App\Http\Controllers\Controller;
use App\Http\Resources\SensorResource;
use App\Http\Traits\HttpResponses;
use App\Models\Sensor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    //
    use HttpResponses;
    public function index(): JsonResponse
    {
        return $this->success(SensorResource::collection(Sensor::get()));
    }
    public function show(Sensor $sensor): JsonResponse
    {
        return $this->success(new SensorResource($sensor));
    }
}
