<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{

    public function incident_types(){
        return $this->hasOne(IncidentType::class,'id','incident_types_picklist');
    }

    public function incident_statuses(){
        return $this->hasOne(IncidentStatus::class,'id','incident_statuses_picklist');
    }
    public function incident_priorities(){
        return $this->hasOne(IncidentPriority::class,'id','incident_priorities_picklist');
    }
    public function created_by_(){
        return $this->hasOne(User::class,'id','created_by');
    }
    public function updated_by_(){
        return $this->hasOne(User::class,'id','updated_by');
    }

}
