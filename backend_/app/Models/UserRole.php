<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'dashboard',
        'warning',
        'database',
        'monitoring',
        'sensor',
        'station',
        'maintenance_warning',
        'notification',
        'recipient',
        'user',
        'user_role',
        'system'
    ];
}
