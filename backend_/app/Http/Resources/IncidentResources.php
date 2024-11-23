<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncidentResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            "id"    => $this->id,
            'status' => $this->warnings->status,
            'value' => $this->value,
            'sensor_type' => $this->warnings->sensors->sensor_type,
            'station_name' => $this->warnings->sensors->stations->name,
            'color' => $this->warnings->color,
            "time" => date('F d Y h:i:s a',strtotime($this->updated_at))
        ];
    }
}
