<?php

namespace App\Http\Controllers;

use App\Helpers\Module as HelpersModule;
use App\Http\Resources\ListResources;
use App\Http\Traits\HttpResponses;
use App\Models\Field;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    //
    use HttpResponses;
    public function index(Request $request){

        $model = DB::table($request->module);
        $model = $model->select($request->columns);
        if(!empty($request->filter)){
            foreach($request->filter as $filter){
                $model = $model->where($filter['field'],"like",$filter['value']."%");
            }
        }
        if($request->search != ""){
            $search = $request->search;
            $module_id = HelpersModule::module_id($request->module);
            $search_columns = Field::where("module_id",$module_id)->where("search",1)->get();
            foreach($search_columns as $search_column){
                $model = $model->orWhere($search_column->name,"like",$search."%");
            }
        }
        $model = $model->where('deleted',0);
        $model = $model->orderByDesc('updated_at');
        $model = $model->paginate(15);
        if($request->module == 'reports'){
            $model->through(function($report){
                $module_details = HelpersModule::module_details($report->modules);
                $report->modules = $module_details->label;
                return $report;
            });
        }
        return $this->success($model);
    }
    public function get_column(Request $request){
        $module_id = HelpersModule::module_id($request->module);
        $model = Field::where("module_id",$module_id)
        ->select("name","label","type","name as field")
        ->where("column",1)
        ->get();
        return $this->success($model);
    }
}
