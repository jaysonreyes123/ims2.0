<?php

namespace App\Imports;

use App\Helpers\FieldValidator;
use App\Helpers\Generate;
use App\Helpers\Module;
use App\Models\Incident;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Import implements ToModel, WithStartRow,WithBatchInserts
{
    /**
    * @param Collection $collection
    */
    public $fields;
    public $module;
    public $header;
    public $duplicate_handling;
    public $duplicate_handling_field;
    public function __construct($header = false,$module="",$fields = "",$duplicate_handling = 1,$duplicate_handling_field = "")
    {
        $this->fields = $fields;
        $this->module = $module;
        $this->header = $header;
        $this->duplicate_handling = $duplicate_handling;
        $this->duplicate_handling_field = $duplicate_handling_field;
    }
    public function model(array $row)
    {

        
        $model = Module::get_module($this->module);
        $check_duplicate_model = Module::check_duplicate($this->module);
        $duplicate_field = $this->get_duplicate_field($this->duplicate_handling_field,$this->fields);
        $update_field = [];
        $table = "import_user_".Auth::id();
        $insert_into_import_table = "INSERT INTO $table ";
        $insert_column = "(";
        $insert_data = "(";
        foreach(json_decode($this->fields,true) as $keys => $values){
            $field      = $values['fields'];
            $value      = $row[$values['position']];
            $field_type = $values['type'];
            $value_     = FieldValidator::validate($this->module,$field,$field_type,$value); 
            $model->$field = $value_;
            $update_field[$field] = $value_;
            $insert_column.="`".$field."`".",";
            $insert_data.="'".$value."'".",";

        }
        
        if($this->duplicate_handling != 1 && count($duplicate_field) != 0){
            foreach($duplicate_field as $key => $values){
                $field_type = $values['type'];
                $field      = $values['fields'];
                $value = $row[$values['position']];
                if($field_type == "picklist"){
                    $value = FieldValidator::validate($this->module,$field,$field_type,$value);
                }
                $check_duplicate_model->where($values['fields'],$value);
            }
        }
       
        
        if($this->module == 'incidents'){
            $model->incident_no = Generate::id($this->module);
            
        }
        $status = 0;
         //skip step
        if($this->duplicate_handling == 1){
            $model->save();
 
            $status = 1;
        }
        //skip the duplicate
        else if($this->duplicate_handling == 2){
            if($check_duplicate_model->count() == 0 || count($duplicate_field) == 0 ){
                $model->save();
                $status = 1;
            }
            else{
                $status = 2;
            }
        }
        //update the duplcate
        else if($this->duplicate_handling == 3){
            if($check_duplicate_model->update($update_field)){
                $status = 3;
            }
            else{
                $status = 0;
            }
        }
        $insert_column.="`status`";
        $insert_data.="$status";
        $insert_data.=" )";
        $insert_column.=" )";
        $query = $insert_into_import_table.$insert_column." values ".$insert_data;
        DB::statement($query);
    }
    public function startRow():int
    {
        return $this->header == true ? 2 : 1;
    }
    public function batchSize(): int
    {
        return 1000;
    }

    public function get_duplicate_field($duplicate_fields,$fields){
        $fields_ = [];
        foreach(json_decode($duplicate_fields,true) as $duplicate_field){
            foreach(json_decode($fields,true) as $keys => $values){
                if($duplicate_field == $values['fields']){
                    $fields_[] = $values;
                }
            }
        }
        return $fields_;
    }
}
