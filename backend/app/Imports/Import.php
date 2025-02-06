<?php

namespace App\Imports;

use App\Helpers\FieldValidator;
use App\Helpers\Generate;
use App\Helpers\Module;
use App\Models\Incident;
use Carbon\Carbon;
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
    public function __construct($header = false,$module="",$fields = "",$duplicate_handling = 1,array $duplicate_handling_field =[] )
    {
        $this->fields = $fields;
        $this->module = $module;
        $this->header = $header;
        $this->duplicate_handling = $duplicate_handling;
        $this->duplicate_handling_field = $duplicate_handling_field;
    }
    public function model(array $row)
    {
        $timestamp = Carbon::now();
        $model_module = DB::table($this->module);
        $insert_field = [];
        $update_field = [];
        $duplicate_field = $this->get_duplicate_field($this->duplicate_handling_field,$this->fields);
        $status = 1;
        $table = "import_user_".Auth::id();
        $insert_into_import_table = "INSERT INTO $table ";
        $insert_column = "(";
        $insert_data = "(";
        foreach(json_decode($this->fields,true) as $keys => $values){
            $field      = $values['fields'];
            $value      = $row[$values['position']];
            $field_type = $values['type'];
            $value_     = FieldValidator::validate($this->module,$field,$field_type,$value); 
            $insert_field[$field] = $value_;
            $update_field[$field] = $value_;
            $insert_column.="`".$field."`".",";
            $insert_data.="'".$value."'".",";
        }
        $insert_field['source'] = 'import';
        $insert_field['created_at'] = $timestamp;
        $insert_field['updated_at'] = $timestamp;
        $insert_field['created_by'] = Auth::id();
        $insert_field['updated_by'] = Auth::id();

        if($this->duplicate_handling != 1 && count($duplicate_field) != 0){
            foreach($duplicate_field as $key => $values){
                $field_type = $values['type'];
                $field      = $values['fields'];
                $value = $row[$values['position']];
                $model_module = $model_module->where($values['fields'],$value);
            }
        }

        $status = 1;
        //check duplicate handling
        if($this->duplicate_handling == 2){
            //check if data is exist
            if($model_module->count() == 0){
                $status = 1;
            }
            else{
                $status = 2;
            }
        }
        else if($this->duplicate_handling == 3){
                $status = 3;
        }
        //insert
        if($status == 1){
            $model_module->insert($insert_field);
        }
        //update
        else if($status == 3){
            if($model_module->update($insert_field)){
            }
            else{
                $status = 0;
            }
        }
        

        //create import table by user
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
        foreach($duplicate_fields as $duplicate_field){
            foreach(json_decode($fields,true) as $keys => $values){
                if($duplicate_field == $values['fields']){
                    $fields_[] = $values;
                }
            }
        }
        return $fields_;
    }
}
