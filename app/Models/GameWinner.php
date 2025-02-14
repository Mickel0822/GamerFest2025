<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameWinner extends Model
{
    use HasFactory;

    protected $table = 'game_winners';

    protected $fillable = [
        'game_id',
        'first_place',
        'second_place',
        'third_place',
    ];

    /**
     * Relación: Un registro pertenece a un juego.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Relación: Primer lugar.
     */
    public function firstPlace()
    {
        return $this->belongsTo(Inscription::class, 'first_place');
    }

    /**
     * Relación: Segundo lugar.
     */
    public function secondPlace()
    {
        return $this->belongsTo(Inscription::class, 'second_place');
    }

    /**
     * Relación: Tercer lugar.
     */
    public function thirdPlace()
    {
        return $this->belongsTo(Inscription::class, 'third_place');
    }
}
