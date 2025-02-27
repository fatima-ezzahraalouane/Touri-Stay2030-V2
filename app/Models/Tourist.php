<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    // use HasFactory;

    protected $table = 'tourists';

    protected $fillable = ['name', 'email', 'password', 'photo', 'role_id', 'country'];
}
