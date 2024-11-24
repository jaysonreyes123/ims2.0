<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    //

    public function resources_type(){
        return $this->hasOne(ResourcesType::class,'id','resources_type_picklist');
    }

    public function resources_status(){
        return $this->hasOne(ResourcesStatus::class,'id','resources_status_picklist');
    }

    public function dispatch(){
        return $this->hasOne(ResourcesDispatcher::class,'id','dispatch_picklist');
    }
    public function condition(){
        return $this->hasOne(ResourcesCondition::class,'id','condition_picklist');
    }
}
