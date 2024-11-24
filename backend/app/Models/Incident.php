<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{

    public function incident_type(){
        return $this->hasOne(IncidentType::class,'id','incident_type_picklist');
    }

    public function incident_status(){
        return $this->hasOne(IncidentStatus::class,'id','incident_status_picklist');
    }
    public function incident_priority(){
        return $this->hasOne(IncidentPriority::class,'id','incident_priority_picklist');
    }

}
