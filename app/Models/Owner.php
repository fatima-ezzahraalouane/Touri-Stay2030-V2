<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    // use HasFactory;

    protected $table = 'owners';

    protected $fillable = ['name', 'email', 'password', 'photo', 'role_id', 'phone_number'];
}
