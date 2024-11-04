<?php

namespace App\Http\Resources;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarningResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "sensor_id" => $this->sensor_id,
            "sensor_thresholds" => $this->sensor_thresholds,
            "color" => $this->color,
            "station_id" => $this->sensors->station_id,
            "station_name" => Station::where('id',$this->sensors->station_id)->first()->name,
            "sensor_type" => $this->sensors->sensor_type,
            "sensor_description" => $this->sensors->sensor_types->description,
            "status" =>$this->status,
            "is_check" =>$this->is_check
        ];
    }
}
