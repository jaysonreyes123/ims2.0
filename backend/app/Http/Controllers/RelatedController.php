<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogs;
use App\Helpers\Module as HelpersModule;
use App\Http\Traits\HttpResponses;
use App\Models\ActivityLog;
use App\Models\Field;
use App\Models\Module;
use App\Models\RelatedBlock;
use App\Models\RelatedEntriesAll;
use App\Models\RelatedEntry;
use App\Models\RelatedMenu;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RelatedController extends Controller
{
    //
    use HttpResponses;
    public function get_related_menu($module){
        $module_id = HelpersModule::module_id($module);
        $model = RelatedMenu::with('related_menus')->where("module",$module_id)->get();
        return $this->success($model);
    }
    public function delete($module,$related_module,$module_id,$related_module_id){
        $module_ = HelpersModule::module_id($module);
        $related_module_ = HelpersModule::module_id($related_module);
        $model = RelatedEntry::where("module",$module_)
        ->where("related_module",$related_module_)
        ->where("module_id",$module_id)
        ->where("related_id",$related_module_id)
        ->delete();
        if($model){
            RelatedEntriesAll::where("module",$module_)
            ->where("related_module",$related_module_)
            ->where("module_id",$module_id)
            ->where("related_id",$related_module_id)
            ->where('relation',1)
            ->delete();
            ActivityLogs::log($module_id,$module_,status:5,related_module:$related_module_,related_item_id:$related_module_id);
            return $this->success($model);
        }
    }
    public function related_list(Request $request,$id,$module,$related_module){
        $module_ = HelpersModule::module_id($module);
        $related_module_ = HelpersModule::module_id($related_module);
        $related_entries_id = RelatedEntry::where('module_id',$id)->where("module",$module_)->where("related_module",$related_module_)->pluck('related_id');
        
        if($request->option == 1){
            $model = DB::table($related_module)->whereNotIn('id',$related_entries_id);
        }   
        else{
            $model = DB::table($related_module)->whereIn('id',$related_entries_id);
        }
        
        if($request->search != ""){
            $search = $request->search;
            $module_id = HelpersModule::module_id($related_module);
            $search_columns = Field::where("module_id",$module_id)->where("search",1)->get();
            $model->where(function($query) use ($search_columns,$search){
                foreach($search_columns as $search_column){
                    $query->orWhere($search_column->name,"like","$search%");
                }
            });
        }
        $model = $model->where('deleted',0);
        $model = $model->orderByDesc('updated_at');
        $model = $model->paginate(15);
        if (Schema::hasColumn($related_module, 'assigned_to')) {
            $model->through(function($assigned_to){
                $user_model = User::where('id',$assigned_to->assigned_to)->first();
                $assigned_to->assigned_to = $user_model->name ?? "";
                return $assigned_to;
            });   
        }
        return $this->success($model);
    }
    public function save(Request $request){
        $id = $request->id;
        $related_id = $request->related_id;
        $module_id = HelpersModule::module_id($request->module);
        $related_module_id  = HelpersModule::module_id($request->related_module);
        $fields = Field::select('table', 'name')->where('module_id', $related_module_id)->get();
        $field_with_table = [];
        foreach ($fields as $field) {
            $field_with_table[$field->table][$field->name] = $request[$field->name];
        }
        foreach ($field_with_table as $table => $fields) {

            foreach ($fields as $field => $value) {
                $form_data[$field] = $value;
            }
            //get old value before update
            $timestamp = Carbon::now();
            if ($related_id != "") {
                $old_value = DB::table($table)->where('id', $id)->first();
                $form_data['updated_at'] = $timestamp;
                $form_data['updated_by'] = Auth::id();
            }
            else{
                $form_data['created_at'] = $timestamp;
                $form_data['updated_at'] = $timestamp;
                $form_data['created_by'] = Auth::id();
                $form_data['updated_by'] = Auth::id();
            }
            $model = DB::table($table)->updateOrInsert(
                ["id" => $related_id],
                $form_data
            );
            //check if the update was success then create logs
            $model_id = DB::getPdo()->lastInsertId();
            if ($model) {
                if ($related_id != "") {
                   //ActivityLogs::log($request->module, $id, "update", $old_value, $request->all());
                } else {
                    $related_model = new RelatedEntry();
                    $related_model->module_id = $id;
                    $related_model->module = $module_id;
                    $related_model->related_id = $model_id;
                    $related_model->related_module = $related_module_id;
                    $related_model->save();
                    ActivityLogs::log($id,$module_id,$status = 4,related_module:$related_module_id,related_item_id:$model_id);
                   //ActivityLogs::log($request->related_module, $model_id, "created");
                }
            }
        }
    }
    public function save_selected_row(Request $request){
        $id = $request->id;
        $module_id = HelpersModule::module_id($request->module);
        $related_module_id  = HelpersModule::module_id($request->related_module);
        foreach($request->selected_row as $related_id){
            $related_model = new RelatedEntry();
            $related_model->module = $module_id;
            $related_model->related_module = $related_module_id;
            $related_model->module_id = $id;
            $related_model->related_id = $related_id;
            if($related_model->save()){
                ActivityLogs::log($id,$module_id,status:4,related_module:$related_module_id,related_item_id:$related_id);
            }
        }
    }
    public function get_related_blocks($module,$related_module){
        $module_id = HelpersModule::module_id($module);
        $related_module_id = HelpersModule::module_id($related_module);
        $model = RelatedBlock::with(['blocks' => function($query){
            return $query->with('fields');
        }])
        ->where('module',$module_id)
        ->where("related_module",$related_module_id)
        ->get();

        return $this->success($model);
    }
}
