<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedMenu extends Model
{
    //
    public function related_menus(){
        return $this->hasOne(Module::class,'id','related_module');
    }
}
