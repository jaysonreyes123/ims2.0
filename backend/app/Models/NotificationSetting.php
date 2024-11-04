<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    use HasFactory;
/**
     * @var array
     */
    protected $casts = ['recipient' => 'array'];
    protected $fillable = [
        'name',
        'body',
        'recipient',
        'sensor_id'
    ];
  

    public function sensors(){
        return $this->hasOne(Sensor::class,'id','sensor_id');
    }
}
