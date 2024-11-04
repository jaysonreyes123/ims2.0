<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SensorResource extends JsonResource
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
            "sensor_type_name" => $this->sensor_types->name,
            "sensor_description" => $this->sensor_types->description,
            "sensor_type" => $this->sensor_type,
            "station_id" => $this->stations->id,
            "station_name" => $this->stations->name,
            "location" => $this->stations->location,
            "status" => $this->sensor_status_->status == 0 ? 'Inactive' : 'Active',
            "last_scan" => date("Y-m-d H:i:s",strtotime($this->sensor_status_->updated_at))
        ];
    }
}
