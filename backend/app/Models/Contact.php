<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    public function caller_types(){
        return $this->hasOne(CallerType::class,'id','caller_types_picklist');
    }
    public function municipalities(){
        return $this->hasOne(Municipality::class,'id','municipalities_picklist');
    }
    public function barangays(){
        return $this->hasOne(Barangay::class,'id','barangays_picklist');
    }
    
}
