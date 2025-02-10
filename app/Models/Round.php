<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'name',
        'order',
        'type', // Tipo de ronda
        'start_time',
        'end_time',
    ];

    /**
     * Relación: Una ronda pertenece a un juego.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Relación: Una ronda tiene muchas inscripciones.
     */
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    /**
     * Relación: Una ronda tiene muchos resultados.
     */
    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function allMatchesResolved(): bool
    {
        return $this->results()->whereNull('winner_id')->doesntExist();
    }

}
