<?php

namespace App\Http\Resources;

use App\Models\NotificationSetting;
use App\Models\Recipient;
use Illuminate\Http\Request;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $output = array();
        if(isset($this->recipient)){
            foreach($this->recipient as $recipient){
                $models = Recipient::where('id',$recipient)->get();
                if(!$models->isEmpty()){
                    foreach($models as $model){
                        $output[] = $model->name;
                    }
                }
            }
        }
        return [
            "id" => $this->id,
            "sensor_id" => $this->sensor_id,
            "sensor_description" => $this->sensors->sensor_types->description,
            "name" => $this->name,
            "body" => $this->body,
            "recipient" => $this->recipient,
            "recipient_name" => $output
        ];
    }
}
