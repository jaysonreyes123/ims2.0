<?php

namespace App\Http\Resources;

use App\Helpers\Module;
use App\Models\Field;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class SystemLogsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $related_entityname = "";
        $related_module = "";

        $module_details = $this->get_module_label($this->module);
        $columns = explode(",",$module_details->entityname);
        $get = DB::table($module_details->name)
        ->select($columns)
        ->where("id",$this->itemid)->first();
        $entityname = "";
        foreach($columns as $column){
            $entityname.=$get->$column." ";
        }
        $entityname = rtrim($entityname," ");

        if($this->status == 4 || $this->status == 5){
            $related_module_details = $this->get_module_label($this->activity_relations->related_module); 
            $columns = explode(",",$related_module_details->entityname);
            $get = DB::table($related_module_details->name)
            ->select($columns)
            ->where("id",$this->activity_relations->related_item_id)->first();
            foreach($columns as $column){
                $related_entityname.=$get->$column." ";
            }
            $related_module = $related_module_details->name;
            $related_entityname = rtrim($related_entityname," ");
        }
        return [
            "itemid" => $this->itemid,
            "relatedid" => $this->activity_relations->related_item_id ?? "",
            "module" => $module_details->name,
            "related_module" => $related_module,
            'whodid' => $this->whodid_->name,
            "status" => $this->status($this->status),
            "field" => $entityname,
            "related_field" => $related_entityname,
            'timestamp' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
    public function status($status){
        $action = "";
        switch ($status) {
            case 1:
                $action = 'Created';
                break;
            case 2:
                $action = 'Updated';
                break;
            case 3:
                $action = 'Deleted';
                break;
            case 4:
                $action = 'Linked';
                break;
            case 5:
                $action = 'Unlinked';
                break;
            default:
                # code...
                break;
        }
        return $action;
    }
    public function get_module_label($module){
        $module_ = Module::module_details_by_id($module);
        return $module_;
    }
    public function get_label($module,$field){
        $field = Field::where('module_id',$module)->where('name',$field)->first();
        return $field->label ?? ""; 
    }
}
