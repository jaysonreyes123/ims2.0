<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = parent::toArray($request);
        $response['created_at'] = Carbon::parse($response['created_at'])->format('Y-m-d H:i:s');
        $response['updated_at'] = Carbon::parse($response['updated_at'])->format('Y-m-d H:i:s');
        $response['created_by'] = $this->get_user($response['created_by']);
        $response['updated_by'] = $this->get_user($response['updated_by']);
        return $response;
    }
    public function get_user($id){
        $user_model = User::find($id);
        return $user_model->name ?? "";
    }
}
