<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'number',
        'description',
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
}
