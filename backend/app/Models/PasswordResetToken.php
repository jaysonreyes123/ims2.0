<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'email';
    protected $fillable = ['email', 'token', 'create_at'];
}
