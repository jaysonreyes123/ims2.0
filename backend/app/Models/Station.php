<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    //SENSOR TYPE
    const RAIN_GAUGE            = 'REG20000';
    const WATER_LEVEL           = 'REG20001';
    const EXTERNAL_POWER_SUPPLY = 'EXTPWR';

    const RG                    = 1;
    const WL                    = 2;
    const EXP                   = 3;

    const WL_LEVEL              = 1000;

    const CURRENT_TIME          = 5;
    const CURRENT_TIME_TYPE     = "minute";
    
    
    const SENSOR_TYPE           = array(Station::RAIN_GAUGE => 1,Station::WATER_LEVEL => 2,Station::EXTERNAL_POWER_SUPPLY => 3);
    const THRESHOLD_MEASUREMENT = array(1 => array(1,"hour"), 2 => array(5,"minute") );

    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'coordinates',
        'location',
        'river_bed',
        'water_surface',
        'code',
        'status'
    ];

    public function sensors(){
        return $this->hasMany(Sensor::class,'station_id','id');
    }
    public function latest_intervals(){
        return $this->hasOne(LatestInterval::class,'station_id','id');
    }
}
