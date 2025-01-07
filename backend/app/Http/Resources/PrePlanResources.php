<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrePlanResources extends JsonResource
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
        $response['updated_at'] = Carbon::parse($this->updated_at)->format('Y-m-d H:i:s');
        $response['created_by'] = $this->created_by_->name ?? "";
        $response['updated_by'] = $this->updated_by_->name ?? "";
        return $response;
    }
}
