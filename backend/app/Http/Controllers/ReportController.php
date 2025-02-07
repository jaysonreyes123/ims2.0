<?php

namespace App\Http\Controllers;

use App\Exports\ExportReport;
use App\Helpers\Module;
use App\Http\Traits\HttpResponses;
use App\Models\Field;
use App\Models\Report;
use App\Models\ReportChart;
use App\Models\ReportColumn;
use App\Models\ReportCondition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;

    public function get_column($id){
        $model = Report::with('report_columns')->find($id);
        return $this->success($model);
    }
    public function generate($type,$id){
        $report_model = Report::find($id);
        $report_name = $report_model->report_name.".".$type;
        $format = $type == 'xlsx' ? \Maatwebsite\Excel\Excel::XLSX : \Maatwebsite\Excel\Excel::CSV;
        return Excel::download(new ExportReport($report_model),$report_name,$format);
    }
    public function get_fields(Request $request){
        $data = [];
        $module = $request->module;
        $related_modules = $request->related_module;
       
        $module_ = Module::module_details($module);
        $data[$module_->label] = Field::where('module_id',$module_->id)->where('display_type',[1,2,3])->get();
        if(!empty($related_modules)){
            foreach($related_modules as $related_module){
                $related_module_ = Module::module_details($related_module);
                $data[$related_module_->label] = Field::where('module_id',$related_module_->id)->get();
            }
        }
        return $this->success($data);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function column_label($fields){
        $field_ = [];
        foreach($fields as $field){
            $field_[$field->name] = $field->label;
        }
        return $field_;
    }
    public function fields_($columns){
        $data = [];
        foreach($columns as $column){
            $columns_ = explode(".",$column); 
            $data[$columns_[0]][] = $columns_[1];
        }
        return $data;
    }

    public function get_chart($id){
        $report_model = Report::find($id);
        $primary_table = $report_model->modules;
        $column = $report_model->report_charts->groupby;
        $column_ = str_replace(".","_",$report_model->report_charts->groupby);
        $columns = array("$column as $column_",DB::raw("COUNT($column) as count"));
        $report_condition_model = $report_model->report_conditions;
        $model = DB::table($report_model->modules)
        ->select($columns);
        $related_module = json_decode($report_model->related_module);
        if(!empty($related_module)){
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
            $primary_module_id = Module::module_id($report_model->modules);  
            $model = $model->where("module",$primary_module_id); 
            $model = $model->whereIn("related_module",$related_module_id);
        }
        foreach($report_condition_model as $report_condition){
            $model = $model->where($report_condition->column,$report_condition->operator,$report_condition->value);
        }
        $model->where("$primary_table.deleted",0);
        $model->groupBy($column);
        $model->orderBy("$primary_table.id","asc");
        $output = [];
        if($model->count() == 0){
            $output['label'][] = "No Data";
            $output['count'][] = 0;
        }
        else{
            foreach($model->get() as $row){
                $output['label'][] = $row->$column_;
                $output['count'][] = $row->count;
            }
        }
        return $output;   
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {
        //
        $report_model = Report::find($id);
        $report_column_model = $report_model->report_columns;
        $report_condition_model = $report_model->report_conditions;
        $get_assigned_to_column = "";
        foreach($report_column_model as $report_column){
            $parse_column = explode(".",$report_column->column);
            $column__ = $report_column->column ." as ".str_replace(".","_",$report_column->column);
            if($parse_column[1] == 'assigned_to'){
                $get_assigned_to_column = str_replace(".","_",$report_column->column);
            }
            $columns[] = $column__;
        }
        $primary_table = $report_model->modules;
        $model = DB::table($report_model->modules)
        ->select($columns);
        $related_module = json_decode($report_model->related_module);
        if(!empty($related_module)){
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
            $primary_module_id = Module::module_id($report_model->modules);  
            $model = $model->where("module",$primary_module_id); 
            $model = $model->whereIn("related_module",$related_module_id);
        }
        foreach($report_condition_model as $report_condition){
            $model = $model->where($report_condition->column,$report_condition->operator,$report_condition->value);
        }
        if(isset($request->limit)){
            $model = $model->limit($request->limit)->get();
        }
        if($get_assigned_to_column != ""){
            $model->map(function($assigned_to) use ($get_assigned_to_column){
                $user_model = User::where('id',$assigned_to->$get_assigned_to_column)->first();
                $assigned_to->$get_assigned_to_column = $user_model->name ?? "";
                return $assigned_to;
            });
        }
        return $this->success($model);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $model = Report::with('report_columns','report_conditions','report_charts')->find($id);
        return $this->success($model);
    }

    public function save_list($request,$id = ""){
        if($id == ""){
            $model = new Report();
        }
        else{
            $model = Report::find($id);
            ReportColumn::where("report_id",$id)->delete();
            ReportCondition::where("report_id",$id)->delete();
        }
        $related_module = $request->related_module;
        $model->report_name = $request->report_name;
        $model->modules = $request->modules;
        $model->type = $request->type;
        $model->group_by = $request->group_by;
        $model->data_field = $request->data_field;
        $model->related_module = json_encode($related_module);
        $columns = $this->fields_($request->selected_column);
        if($model->save()){
            foreach($columns as $key => $columns_){
                $module_id = Module::module_id($key);
                $fields = Field::where("module_id",$module_id)->get();
                $field_with_label = $this->column_label($fields);
                foreach($columns_ as $column){
                    $report_column_model = new ReportColumn();
                    $report_column_model->report_id = $model->id;
                    $report_column_model->column = $key.".".$column;
                    $report_column_model->label = $field_with_label[$column];
                    $report_column_model->save();
                }
            }   
            //filter and
            foreach($request->filter as $filter){
                if($filter['field'] != ""){
                    $report_condition_model = new ReportCondition();
                    $report_condition_model->report_id = $model->id;
                    $report_condition_model->column = $filter['field'];
                    $report_condition_model->operator = $filter['operator'];
                    $report_condition_model->value = $filter['value'];
                    $report_condition_model->type = $filter['type'];
                    $report_condition_model->save();
                }   
            }
        }
        return $this->success($model);
    }
    public function save_chart($request,$id = ""){
        if($id == ""){
            $model = new Report();
            $report_chart_model = new ReportChart();
        }
        else{
            $model = Report::find($id);
            $report_chart_model = ReportChart::where("report_id",$id)->first();
            ReportCondition::where("report_id",$id)->delete();
        }

        $related_module = $request->related_module;
        $model->report_name = $request->report_name;
        $model->modules = $request->modules;
        $model->type = 'chart';
        $model->group_by = $request->group_by;
        $model->data_field = $request->data_field;
        $model->related_module = json_encode($related_module);
        if($model->save()){
            $report_chart_model->report_id      = $model->id;
            $report_chart_model->chart          = $request->chart['type'];
            $report_chart_model->dataset        = json_encode($request->chart['dataset']);
            $report_chart_model->groupby        = $request->chart['group_by'];
            $report_chart_model->save();
            foreach($request->filter as $filter){
                if($filter['field'] != ""){
                    $report_condition_model = new ReportCondition();
                    $report_condition_model->report_id = $model->id;
                    $report_condition_model->column = $filter['field'];
                    $report_condition_model->operator = $filter['operator'];
                    $report_condition_model->value = $filter['value'];
                    $report_condition_model->type = $filter['type'];
                    $report_condition_model->save();
                }   
            }
        }
        return $this->success($model);
    }
    public function store(Request $request)
    {
        //
        if($request->type == 'list'){
            return $this->save_list($request);
        }
        else{
            return $this->save_chart($request);
        }
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->type == 'list'){
            return $this->save_list($request,$id);
        }
        else{
            return $this->save_chart($request,$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function pin($id,$pinvalue){
        $model = Report::find($id);
        $model->pin = $pinvalue;
        $model->save();
        return $this->success([]);
    }
}
