<?php

namespace App\Http\Resources;

use App\Helpers\Module;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class AcitvityLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = [];
        if($this->status == 2){
            if(count($this->activity_details)){
                foreach($this->activity_details as $field_){
                    $sub_field = [];
                    $sub_field['label'] = $this->get_label($this->module,$field_->field);
                    $sub_field['oldvalue'] = $field_->oldvalue;
                    $sub_field['newvalue'] = $field_->newvalue;
                    $fields[] = $sub_field;
                }
            }
        }
        else if($this->status == 4 || $this->status == 5){
            $module_details = Module::module_details_by_id($this->activity_relations->related_module); 
            $columns = explode(",",$module_details->entityname);
            $get = DB::table($module_details->name)
            ->select($columns)
            ->where("id",$this->activity_relations->related_item_id)->first();
            $entityname = "";
            foreach($columns as $column){
                $entityname.=$get->$column." ";
            }
            $entityname = rtrim($entityname," ");
            $fields = array("module" => $module_details->label,"entityname" => $entityname);
        }
        return [
            'status' => $this->status,
            'action' => $this->status($this->status),
            'whodid' => $this->whodid_->name,
            'created_at' => $this->created_at,
            'fields' => $fields
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
    public function get_label($module,$field){
        $field = Field::where('module_id',$module)->where('name',$field)->first();
        return $field->label ?? ""; 
    }
}
