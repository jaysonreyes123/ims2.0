<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
    public function blocks(){
        return $this->hasMany(Block::class,'module_id','id');
    }
}
