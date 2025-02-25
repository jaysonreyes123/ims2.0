<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $module_details = $this->module_;
        $columns = explode(",",$module_details->entityname);
        $get = DB::table($module_details->name)
            ->select($columns)
            ->where("id",$this->module_item_id)->first();
        $entityname = "";
        foreach($columns as $column){
            $entityname.=$get->$column." ";
        }
        return [
            "id" => $this->id,
            "module" => $this->module_->name,
            "itemid" => $this->module_item_id,
            "label" => $this->module_->label,
            "name" => $entityname,
            "status" => $this->status,
            "timestamp" => $this->created_at->diffForHumans(),
            "icon" => $this->module_->icon
        ];
    }
}
