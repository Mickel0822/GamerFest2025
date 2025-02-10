<?php

namespace App\Mail;

use App\Models\Inscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public Inscription $inscription;

    /**
     * Create a new message instance.
     */
    public function __construct(Inscription $inscription)
    {
        $this->inscription = $inscription;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Estado de inscripción actualizado')
            ->view('emails.payment-status')
            ->with([
                'gameName' => $this->inscription->game->name,
                'status' => $this->inscription->status,
                'userName' => $this->inscription->user->name,
            ]);
    }
}
