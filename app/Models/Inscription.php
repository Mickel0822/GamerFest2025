<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentStatusChanged;
use Illuminate\Support\Facades\Log;
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
        'round_id',
        'is_eliminated',
        'receipt_number',
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
     * Filtrar inscripciones no eliminadas.
     */
    public function scopeActive($query)
    {
        return $query->where('is_eliminated', false);
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

        // Evento para verificar el cambio de estado antes de guardar
        static::saving(function ($inscription) {
            // Verifica si el estado ha cambiado
            /*if ($inscription->isDirty('status')) {
                $previousStatus = $inscription->getOriginal('status');
                $newStatus = $inscription->status;

                // Si el estado cambió, envía el correo
                Log::info('El estado ha cambiado', [
                    'previous_status' => $previousStatus,
                    'new_status' => $newStatus,
                    'inscription_id' => $inscription->id
                ]);

                try {
                    Mail::to($inscription->user->email)->send(new PaymentStatusChanged($inscription));
                    Log::info('Correo de estado de pago enviado con éxito.', [
                        'email' => $inscription->user->email,
                        'status' => $newStatus,
                        'inscription_id' => $inscription->id
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error al enviar el correo de estado de pago.', [
                        'email' => $inscription->user->email,
                        'status' => $newStatus,
                        'inscription_id' => $inscription->id,
                        'error' => $e->getMessage()
                    ]);
                }
            } else {
                Log::info('El estado no ha cambiado, no se enviará correo.');
            }*/


            if ($inscription->isDirty('status')) {
                $previousStatus = $inscription->getOriginal('status');
                $newStatus = $inscription->status;

                // Si el estado cambió, envía el correo
                try {
                    Mail::to($inscription->user->email)->send(new PaymentStatusChanged($inscription));
                } catch (\Exception $e) {
                    // Si ocurre un error, puedes manejarlo de alguna manera (sin log)
                    // Aquí podrías agregar algún tipo de manejo del error o una notificación
                }
            } else {
                // No se enviará correo si el estado no ha cambiado
            }
        });

        // Lógica para eliminar el archivo de recibo cuando se elimina la inscripción
        static::deleting(function ($inscription) {
            if ($inscription->payment_receipt) {
                Storage::disk('s3')->delete($inscription->payment_receipt);
            }
        });
    }
}
