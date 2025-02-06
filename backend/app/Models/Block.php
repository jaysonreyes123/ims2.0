<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    //
    public function fields(){
        return $this->hasMany(Field::class,'block_id','id');
    }
}
