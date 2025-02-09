<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'round_id',
        'match_type',
        'player_one_id',
        'player_two_id',
        'winner_type',
        'winner_id',
    ];

    protected $guarded = ['round_id', 'player_one_id', 'player_two_id'];
    /**
     * Relación: Un resultado pertenece a una ronda.
     */
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function playerOne()
    {
        return $this->belongsTo(Inscription::class, 'player_one_id'); // Si el jugador es un equipo, este relaciona con `team_name`
    }

    public function playerTwo()
    {
        return $this->belongsTo(Inscription::class, 'player_two_id'); // Igual para el segundo jugador/equipo
    }

    public function winnerPlayer()
    {
        return $this->belongsTo(Inscription::class, 'winner_id');
    }

    public function winnerTeam()
    {
        return $this->belongsTo(Inscription::class, 'winner_id');
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(Inscription::class, 'winner_id');
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
    

    public function getPlayerOneNameAttribute(): string
    {
        return $this->playerOne?->team_name ?? $this->playerOne?->user?->name ?? 'Sin asignar';
    }

    public function getPlayerTwoNameAttribute(): string
    {
        return $this->playerTwo?->team_name ?? $this->playerTwo?->user?->name ?? 'Sin asignar';
    }

    public function getWinnerNameAttribute(): string
    {
        if ($this->winner_type === 'player') {
            return $this->winnerPlayer?->user?->name ?? 'Sin asignar';
        }

        if ($this->winner_type === 'team') {
            return $this->winnerTeam?->team_name ?? 'Sin asignar';
        }

        return 'Sin asignar';
    }

}
