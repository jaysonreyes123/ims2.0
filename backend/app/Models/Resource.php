<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    //

    public function resources_types(){
        return $this->hasOne(ResourcesType::class,'id','resources_types_picklist');
    }

    public function resources_statuses(){
        return $this->hasOne(ResourcesStatus::class,'id','resources_statuses_picklist');
    }

    public function dispatchers(){
        return $this->hasOne(ResourcesDispatcher::class,'id','dispatchers_picklist');
    }
    public function conditions(){
        return $this->hasOne(ResourcesCondition::class,'id','conditions_picklist');
    }
    public function created_by_(){
        return $this->hasOne(User::class,'id','created_by');
    }
    public function updated_by_(){
        return $this->hasOne(User::class,'id','updated_by');
    }
}
