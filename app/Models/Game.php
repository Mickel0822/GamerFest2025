<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'name',
        'type',
        'status',
        'rules',
        'results',
        'image_url',
        'start_time',
        'end_time',
        'location',
        'coordinator_id',
    ];

    /**
     * Relación: Un juego tiene un coordinador (1:1 inverso).
     */
    public function coordinator()
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    }

    /**
     * Relación: Un juego tiene muchas inscripciones.
     */
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    /**
     * Relación: Un juego tiene muchas rondas.
     */
    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

}
