<?php

namespace App\Exports;

use App\Helpers\Module;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportReport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    private $report_model;
    public function __construct($report_model)
    {
        $this->report_model = $report_model;
    }
    public function collection()
    {
        //
        $module = $this->report_model->modules;
        $report_columns = $this->report_model->report_columns;
        $headers = [];
        $get_assigned_to_column = "";
        foreach($report_columns as $columns){
            $parse_column = explode(".",$columns->column);
            if($parse_column[1] == 'assigned_to'){
                $get_assigned_to_column = $columns->column;
            }
            $headers[] = $columns->column;
        }
        $model =  DB::table($module);
        $model = $model->select($headers);
        $related_module = json_decode($this->report_model->related_module);
        if(!empty($related_module)){
            $primary_table = $primary_table = $this->report_model->modules;
            $model->leftJoin('related_entries',"$primary_table.id", '=', "related_entries.module_id" );
            $related_module_id = [];
            foreach($related_module as $related_table){
                $related_module_id_ = Module::module_id($related_table);
                $related_module_id[] = $related_module_id_;
                $model->leftJoin($related_table,function($join) use ($related_table,$related_module_id_) {
                    $join->on("related_entries.related_id","=","$related_table.id" );
                    $join->on("related_entries.related_module","=",DB::raw('CAST('.$related_module_id_.' as int)'));
                });
            }
            $primary_module_id = Module::module_id($this->report_model->modules);  
            $model = $model->where("module",$primary_module_id); 
            $model = $model->whereIn("related_module",$related_module_id);
        }
        foreach($this->report_model->report_conditions as $conditon){
            $model = $model->where($conditon->column,$conditon->operator,$conditon->value);
        }
        $model = $model->get();
        if($get_assigned_to_column != ""){
            $model->map(function($assigned_to){
                $user_model = User::where('id',$assigned_to->assigned_to)->first();
                $assigned_to->assigned_to = $user_model->name ?? "";
                return $assigned_to;
            });
        }
        return $model;
    }
    
    public function headings():array
    {
        $header = [];
        $report_columns = $this->report_model->report_columns;
        foreach($report_columns as $column){
            $header[] = $column->label;
        }
        return $header;
    }
}
