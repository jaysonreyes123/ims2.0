<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'station_id',
        'sensor_type'
    ];

    public function warnings(){
        return $this->hasMany(Warning::class,'sensor_id','id')->orderBy("sensor_thresholds","DESC");
    }
    public function stations(){
        return $this->hasOne(Station::class,'id','station_id');
    }
    public function notifications(){
        return $this->hasOne(NotificationSetting::class,'sensor_id','id');
    }
    public function sensor_types(){
        return $this->hasOne(SensorType::class,'id','sensor_type');
    }
    public function sensor_status_(){
        return $this->hasOne(SensorStatus::class,'sensor_id','id');
    }

    public function sensor_status_many_(){
        return $this->hasMany(SensorStatus::class,'sensor_id','id');
    }
    public function sensor_data(){
        return $this->hasMany(SensorData::class,'sensor_id','id');
    }
}
