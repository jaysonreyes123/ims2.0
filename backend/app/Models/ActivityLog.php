<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    public function users_(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
