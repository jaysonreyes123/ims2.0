<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogs;
use App\Helpers\Generate;
use App\Helpers\Module as HelpersModule;
use App\Helpers\NotificationHelper;
use App\Http\Requests\ModuleRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\ModuleResources;
use App\Http\Traits\HttpResponses;
use App\Models\Field;
use App\Models\Module;
use App\Models\RelatedEntriesAll;
use App\Models\RelatedEntry;
use App\Models\RelatedField;
use App\Models\User;
use App\Models\UserPrivilege;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HttpResponses;
    public function index(){
        $model = Module::all();
        return $this->success($model);
    }
    public function edit_form(string $module,string $option){
        if($option == "summary"){
            $model = Module::with(['blocks'=>function($query){
                return $query
                ->withCount(['fields'=>function($query_field){
                    $query_field->select('id');
                    $query_field->where('summary',1)->whereIn('display_type',[1,2,3]);
                }])
                ->with(['fields'=>function($query_field){
                    $query_field->where('summary',1)->whereIn('display_type',[1,2,3]);
                }])
                ->having('fields_count','<>',0);
            }])
            ->where('name',$module)
            ->first();
        }
        else{
            $model = Module::with(['blocks'=>function($query){
                return $query->with(['fields'=>function($query_field){
                    $query_field->with('related_fields');
                    $query_field->whereIn('display_type',[1,2,3]);
                }]);
            }])
            ->where('name',$module)
            ->first();
        }
        return $this->success($model);
    }

    public function get_fields($module){
        $module_id = HelpersModule::module_id($module);
        $model = Field::where('module_id',$module_id)->get();
        return $this->success($model);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $module = HelpersModule::module_id($request->module);
        $fields = Field::where('module_id',$module)->get();
        $rules = [];
        foreach($fields as $field){
            $sub_rule = [];
            if($field->type == 'number'){
                $sub_rule[] = "numeric";
            }
            if($field->unique == 1){
                $sub_rule[] = Rule::unique($request->module);
            }
            if(!empty($sub_rule)){
                $rules[$field->name] = $sub_rule;
            }
        }
        $request->validate($rules);
        $id = 0;
        $id = $this->save($request);
        return $this->success($id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,Request $request)
    {
        //
        $field_data = [];
        if($request->module == 'users'){
            $user_model = DB::table('users')->where('id',$id)->first();
            $user_privileges_model = DB::table('user_privileges')->where('user_id',$id)->first();
            foreach($user_model as $column => $value){
                if($column != "password"){
                    $field_data[$column] = $value;
                }
            }
            foreach ($user_privileges_model as $column => $value) {
                if($column != "id"){
                    $field_data[$column] = $value == 1 ? true : false;
                }
            }
        }
        else{
            $module_id  = HelpersModule::module_id($request->module);
            $fields = Field::select('table', 'name')->where('module_id', $module_id)->get();
            $field_with_table = [];
            foreach ($fields as $field) {
                $field_with_table[$field->table][$field->name] = $request[$field->name];
            }
            foreach ($field_with_table as $table => $fields) {
                $table_single = DB::table($table)->where('id', $id)->first();
                foreach ($table_single as $field => $value) {
                    if($field == 'assigned_to'){
                        $user_model = User::where('id',$value)->first();
                        $field_data[$field] = $user_model->name ?? "";
                    }
                    else{
                        $field_data[$field] = $value;
                    }
                }
            }
        }
        return $this->success(new ModuleResources($field_data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $module = HelpersModule::module_id($request->module);
        $fields = Field::where('module_id',$module)->get();
        $rules = [];
        $label = [];
        foreach($fields as $field){
            $sub_rule = [];
            if($field->type == 'number'){
                $sub_rule[] = "numeric";
            }
            if($field->type == 'email'){
                $sub_rule[] = 'email';
            }
            if($field->unique == 1){
                $id = (int) $id;
                $sub_rule[] = Rule::unique($request->module)->ignore($id,'id');
            }
            if(!empty($sub_rule)){
                $rules[$field->name] = $sub_rule;
            }
        }
        $request->validate($rules);
        return $this->save($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $model = DB::table($request->module)->where("id",$id)->update(["deleted" => 1]);
        if($model){
            $module_id = HelpersModule::module_id($request->module);
            ActivityLogs::log($id,$module_id,$status = 3);
        }
        return $this->success($model);
    }
    public function delete_all(Request $request,string $module)
    {
        $ids = $request->ids;
        $model = DB::table($module)->whereIn("id",$ids)->update(["deleted" => 1]);
        // if($model){
        //     $module_id = HelpersModule::module_id($request->module);
        //     ActivityLogs::log($id,$module_id,$status = 3);
        // }
        return $this->success($model);
    }
    public function save($request,$id = ""){
        $model_id = "";
        if($request->module == 'users'){
           $model_id = $this->insert_users($request,$id);
        }
        else{
            $module_id  = HelpersModule::module_id($request->module);
            $fields = Field::select('table', 'name')->where('module_id', $module_id)->get();
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
                if($id != ""){
                    $old_value = DB::table($table)->where('id',$id)->first();
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
                    ["id" => $id],
                    $form_data
                );
                //check if the update was success then create logs
                $model_id = DB::getPdo()->lastInsertId();
                
                if($model){
                    if($id != ""){
                        ActivityLogs::log($id,$module_id,$status = 2,$request->all(),$old_value);
                    }
                    else{
                        ActivityLogs::log($model_id,$module_id,$status = 1,$request->all());
                        NotificationHelper::notification($module_id,$model_id);
                    }
                }
            }
        }
        return $model_id;
    }
    public function insert_users($request,$id = ""){
        $request->validate([
            'email' => ['email',Rule::unique('users')->ignore($id)],
        ]);
        if($id == ""){
            $user_model = new User();
            $user_privileges_model = new UserPrivilege();
        }
        else{
            $user_model = User::find($id);
            $user_privileges_model = UserPrivilege::where('user_id',$id);
        }
        
        $user_model->name = $request->name;
        $user_model->email = $request->email;
        $user_model->user_roles = $request->user_roles;
        $user_model->password = Hash::make($request->password);
        $user_model->save();

        $modules = Module::where("presence",1)->get();
        $module_data = [];
        $module_data["user_id"] = $user_model->id;
        foreach($modules as $module){
            $module_name = $module->name;
            $module_data[$module_name] = $request->$module_name;
        }
        $user_privileges_model->updateOrInsert(
            ["user_id" =>$user_model->id],
            $module_data
        );
        return $user_model->id;
    }

    public function get_dropdown(String $field){
        if($field == 'modules'){
            $model = DB::table($field)->whereIn('presence',[1,2])->get();
        }
        else{
            $model = DB::table($field)->get();
        }
        return $this->success($model);
    }
    public function generate($module){
        $generate = Generate::get($module);
        return $generate['prefix'].$generate['current_count'];
    }
    public function get_summary(string $module){
        $module_id = HelpersModule::module_id($module);
        $fields = Field::where('module_id',$module_id)->where('summary',1);
        return $this->success($fields->count());
    }
    public function get_single_item($module,$id){
        $module_details = HelpersModule::module_details($module);
        $columns = explode(",",$module_details->entityname);
        $entityname = "";
        $get = DB::table($module)->where('id',$id)->first();
        foreach($columns as $column){
            $entityname.=$get->$column." ";
        }
        $entityname = rtrim($entityname," ");
        $output = [
            'id' =>$get->id,
            'entityname' => $entityname
        ];
        return $this->success($output);
    }
    public function set_single_item($id,$fieldid,$field){
        $get_related_field = RelatedField::where('fieldid',$fieldid)->first();
        if(!$get_related_field){
            return $this->success([]);
        }  
        $module_details = HelpersModule::module_details_by_id($get_related_field->module);
        $related_module_details = HelpersModule::module_details_by_id($get_related_field->related_module);
        $get_details = DB::table($module_details->name)->select($field)->where('id',$id)->first();   
        $related_item_id = $get_details->$field;
        $get_related_details = DB::table($related_module_details->name)->where('id',$related_item_id)->first();
        if(!$get_related_details){
            return $this->success([]);
        }
        $columns = explode(",",$related_module_details->entityname);
        $entityname = "";
        foreach($columns as $column){
            $entityname.=$get_related_details->$column." ";
        }
        $entityname = rtrim($entityname," ");
        $output = [
            'id' =>$get_related_details->id,
            'entityname' => $entityname
        ];
        return $this->success($output);
    }
}
