<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    //
    public function created_by_(){
        return $this->hasOne(User::class,'id','created_by');
    }
    public function updated_by_(){
        return $this->hasOne(User::class,'id','updated_by');
    }
}
