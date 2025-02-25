<?php

namespace App\Exports;

use App\Helpers\Module;
use App\Helpers\ReportHelper;
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
        $headers = ReportHelper::getColumn($report_columns);
        $column_table = [];
        foreach($report_columns as $columns){
            $parse_column = explode(".",$columns->column);
            if($parse_column[1] == 'assigned_to'){
                $get_assigned_to_column = $columns->column;
            }
            if(!in_array($parse_column[0],$column_table) && $module != $parse_column[0] ){
                $column_table[] = $parse_column[0];
            }
        }
        $model =  DB::table($module);
        $model = $model->select($headers);
        $model = ReportHelper::getRelation($model,$module,$this->report_model->related_module,$column_table);
        $model = ReportHelper::getCondition($model,$module,$this->report_model->report_conditions);
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
