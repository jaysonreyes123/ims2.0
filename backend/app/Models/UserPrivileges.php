<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPrivileges extends Model
{
    //
    public function getIncidentsAttribute($value)
    {
        return $value ? true : false;
    }
    public function getResourcesAttribute($value)
    {
        return $value ? true : false;
    }
    public function getPreplansAttribute($value)
    {
        return $value ? true : false;
    }
    public function getContactsAttribute($value)
    {
        return $value ? true : false;
    }
    public function getAgenciesAttribute($value)
    {
        return $value ? true : false;
    }
    public function getRespondersAttribute($value)
    {
        return $value ? true : false;
    }
    public function getIncidentMapAttribute($value)
    {
        return $value ? true : false;
    }
    public function getHeatMapAttribute($value)
    {
        return $value ? true : false;
    }
    public function getCallLogsAttribute($value)
    {
        return $value ? true : false;
    }
    public function getUsersAttribute($value)
    {
        return $value ? true : false;
    }
}
