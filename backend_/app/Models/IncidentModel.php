<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentModel extends Model
{
    use HasFactory;

    public function warnings(){
        return $this->hasOne(Warning::class,'id','warning_id');
    }
}
