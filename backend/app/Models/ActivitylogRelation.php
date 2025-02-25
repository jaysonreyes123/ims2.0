<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivitylogRelation extends Model
{
    //
    public function modules(){
        return $this->hasOne(Module::class,'id','related_module');
    }
}
