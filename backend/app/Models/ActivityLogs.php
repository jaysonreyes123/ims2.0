<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class ActivityLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'method', 
        'descritions', 
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('M d, Y g:i A');
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
