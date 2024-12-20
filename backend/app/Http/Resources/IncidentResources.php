<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $response = parent::toArray($request);
        $response['created_at'] = Carbon::parse($this->created_at)->format('Y-m-d H:i:s');
        return $response;
    }
}
