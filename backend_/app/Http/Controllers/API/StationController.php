<?php

namespace App\Http\Controllers\API;

use App\Constants\AuthConstants;
use App\Constants\ResponseConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\StationRequest;
use App\Http\Resources\StationResource;
use App\Http\Traits\Access;
use App\Http\Traits\HttpResponses;
use App\Models\Sensor;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StationController extends Controller
{
    use Access;
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    { 
        return $this->success(StationResource::collection(Station::with(['sensors'])->get()));
    } 

    /**
     * @param StationRequest $request
     * @return JsonResponse
     */
    public function store(StationRequest $request): JsonResponse
    {
        $station = Station::create($request->all()); 

        return $this->success(new StationResource($station), class_basename($station) . ResponseConstants::STORE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Station $station): JsonResponse
    {
        // if (!$this->canAccess($station)) {
        //     return $this->error([], AuthConstants::PERMISSION);
        // }

        return $this->success(new StationResource($station));
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(StationRequest $request, Station $station): JsonResponse
    {
        // if (!$this->canAccess($station)) {
        //     return $this->error(AuthConstants::PERMISSION);
        // }

        $station->update($request->all()); 
        return $this->success(new StationResource($station), class_basename($station) . ResponseConstants::UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $station = Station::find($id);
        $station->delete();
        return $this->success($station, ResponseConstants::DESTROY); 
    }
}
