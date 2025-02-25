<?php
namespace App\Helpers;

use App\Models\RelatedField;
use Illuminate\Support\Facades\DB;

class ReportHelper{
    public static function getCondition($model,$primary_table,$conditions){
        foreach($conditions as $report_condition){
            $model = $model->where($report_condition->column,$report_condition->operator,$report_condition->value);
        }
        $model->where("$primary_table.deleted",0);
        return $model;
    }
    public static function getColumn($columns){
        $columns_ = [];
        foreach($columns as $report_column){
            $column__ = $report_column->column ." as ".str_replace(".","_",$report_column->column);
            $columns_[] = $column__;
        }
        return $columns_;
    }
    public static function getRelation($model,$module,$related_module_table,$column_table){
        if(empty($column_table)){
            return $model;
        }
        $module_ = Module::module_details($module);
        $primary_table = $module;
        $related_module = json_decode($related_module_table);
        $related_field_modules = RelatedField::with('related_modules')->where('module',$module_->id)->get();
        if(!$related_field_modules->isEmpty()){
            foreach($related_field_modules as $related_field_module){
                if(!in_array($related_field_module->related_modules->name,$related_module)){
                    $related_module[] = $related_field_module->related_modules->name;
                }
            }
        }    
        if(!empty($related_module)){
            $model->leftJoin('related_entries_alls',"$primary_table.id", '=', "related_entries_alls.module_id" );
            $related_module_id = [];
            foreach($related_module as $related_table){
                $related_module_id_ = Module::module_id($related_table);
                $related_module_id[] = $related_module_id_;
                $model->leftJoin($related_table,function($join) use ($related_table,$related_module_id_) {
                    $related_module_id_ = (int) $related_module_id_;
                    $join->on("related_entries_alls.related_id","=","$related_table.id" );
                    $join->on("related_entries_alls.related_module","=",DB::raw('CAST('.$related_module_id_.' as int)'));
                });
            }
            $model = $model->where("related_entries_alls.module",$module_->id); 
            $model = $model->whereIn("related_entries_alls.related_module",$related_module_id);
        }
        return $model;
    }
}