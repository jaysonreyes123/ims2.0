<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class IncidentMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $allow_extension = ["txt","png","jpg","jpeg","php","pdf","svg","gif","mp4"];
        $response = parent::toArray($request);
        if(in_array($this->extension,$allow_extension)){
            $response['view'] = env('ASSET_URL').Storage::url($this->path);
        }
        else{
            $response['view'] = "";
        }
        return $response;
    }
}
