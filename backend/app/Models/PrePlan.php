<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrePlan extends Model
{
    //
    public function pre_plan_classifications(){
        return $this->hasOne(PrePlanClassification::class,'id','pre_plan_classifications_picklist');
    }
}
