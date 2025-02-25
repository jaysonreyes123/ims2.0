<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    //
    public function workflow_conditions(){
        return $this->hasMany(WorkflowCondition::class,'workflow_id',"id");
    }
    public function modules(){
        return $this->hasOne(Module::class,"id","module");
    }
}
