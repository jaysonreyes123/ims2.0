<?php

namespace App\Http\Controllers;

use App\Http\Traits\HttpResponses;
use App\Imports\Import;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    //
    use HttpResponses;
    public function get_single_data(Request $request){
        $files = $request->file('files');
        $hasheader = $request->hasheader == 'true' ? true :false ;
        $data = Excel::toCollection(new Import($hasheader),$files);
        foreach ($data as $value) {
            return $value[0];
        }
    }   
    public function save_import(Request $request){
        $files  = $request->file('files');
        $fields = $request->fields;
        $module = $request->module;
        $hasheader = $request->hasheader == 'true' ? true :false ;
        $duplicate_handling = $request->duplicate_option;
        $duplicate_handling_field = $request->duplicate_fields;

        $import_user_table = "import_user_".Auth::id();
        $this->create_table($fields,$import_user_table); 
        Excel::import(new Import($hasheader,$module,$fields,$duplicate_handling,json_decode($duplicate_handling_field)),$files);
        return $this->success($this->import_result($import_user_table));
    }
    
    protected function import_result($table){
       return DB::table($table)->get();
    }

    protected function create_table($fields,$table){
        Schema::dropIfExists($table);
        Schema::create($table,function(Blueprint $table) use ($fields) {
            foreach(json_decode($fields,true) as $key => $val){
                $table->string($val['fields'])->nullable();
            }
            $table->integer('status')->nullable();
        });
    }
}
