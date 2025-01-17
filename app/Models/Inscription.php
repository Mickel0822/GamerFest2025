<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Inscription extends Model
{
    protected $fillable = [
        'user_id',
        'game_id',
        'team_name',
        'cost',
        'status',
        'payment_method',
        'payment_receipt',
        'round_id', // Relación con rondas
    ];

    const STATUS_PENDING = 'pendiente';
    const STATUS_VERIFIED = 'verificado';
    const STATUS_REJECTED = 'rechazado';
    /**
     * Relación: Una inscripción pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Una inscripción pertenece a un juego.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Relación: Una inscripción pertenece a una ronda.
     */
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    /**
     * Relación: Una inscripción tiene muchos miembros de equipo.
     */
    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class, 'inscription_id');
    }

    public function getPaymentReceiptUrlAttribute()
    {
        return $this->payment_receipt
            ? Storage::disk('s3')->url($this->payment_receipt)
            : null;
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($inscription) {
            if ($inscription->payment_receipt) {
                Storage::disk('s3')->delete($inscription->payment_receipt);
            }
        });
    }

}