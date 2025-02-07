<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogs;
use App\Helpers\Module as HelpersModule;
use App\Http\Requests\UserRequest;
use App\Http\Resources\ModuleResources;
use App\Http\Traits\HttpResponses;
use App\Models\Field;
use App\Models\Module;
use App\Models\User;
use App\Models\UserPrivilege;
use Carbon\Carbon;
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
    public function edit_form(string $module){
        $model = Module::with(['blocks'=>function($query){
            return $query->with(['fields'=>function($query_field){
                $query_field->whereIn('display_type',[1,2,3]);
            }]);
        }])
        ->where('name',$module)
        ->first();
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
        $id = 0;
        if($request->module == 'users'){
           $id = $this->insert_users($request);
        }   
        else{
            $id = $this->save($request);
        }
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
        //
        return $this->save($request,$id);
        // $model = DB::table($request->module);
        // $form_data = [];
        // foreach($request->all() as $key => $value){
        //     if($key != "module" && $key !="id"){
        //         $form_data[$key] = $value; 
        //     }
        // }+
        // $model = $model->where("id",$id);
        // $old_value = $model->first();
        // $model = $model->update($form_data);
        // ActivityLogs::log($request->module,$id,"update",$old_value,$request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        //
        $model = DB::table($request->module)->where("id",$id)->update(["deleted" => 1]);
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
                        ActivityLogs::log($request->module,$id,"updated",$old_value,$request->all());
                    }
                    else{
                        ActivityLogs::log($request->module,$model_id,"created");
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
        $prefix = Module::where('name',$module)->first();
        $count = DB::table($module)->count();
        return $prefix->prefix.$count+1;
    }
}
