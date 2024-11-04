<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    use HasFactory;


    /**
     * @var array
     */
    protected $fillable = [
        "sensor_id",
        "sensor_thresholds",
        "color",
        "status",
        "is_check"
    ];

    public function sensors(){
        return $this->hasOne(Sensor::class,'id','sensor_id');
    }    
}
