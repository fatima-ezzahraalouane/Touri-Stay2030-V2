<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'annonce_id',
        'date_debut',
        'date_fin',
        'prix_total',
        'statut'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function annonce() {
        return $this->belongsTo(Annonce::class);
    }
}
