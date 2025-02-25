<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    //
    public function related_fields(){
        return $this->hasOne(RelatedField::class,'fieldid','id');
    }
}