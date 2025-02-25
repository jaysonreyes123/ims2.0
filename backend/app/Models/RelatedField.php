<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedField extends Model
{
    //
    public function related_modules(){
        return $this->hasOne(Module::class,'id','related_module');
    }
    public function fields(){
        return $this->hasOne(Field::class,'id','fieldid');
    }
}
