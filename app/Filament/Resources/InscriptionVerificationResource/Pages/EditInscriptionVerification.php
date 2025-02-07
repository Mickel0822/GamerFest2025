<?php

namespace App\Filament\Resources\InscriptionVerificationResource\Pages;

use App\Filament\Resources\InscriptionVerificationResource;
use App\Mail\PaymentStatusChanged;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EditInscriptionVerification extends EditRecord
{
    protected static string $resource = InscriptionVerificationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave()
    {
        $record = $this->record;

        Log::info('Ejecutando afterSave', [
            'inscription_id' => $record->id,
            'status' => $record->status
        ]);

        // Verifica si el estado ha cambiado antes de enviar el correo
        if ($record->isDirty('status')) {
            Log::info('El estado ha cambiado', [
                'previous_status' => $record->getOriginal('status'),
                'new_status' => $record->status
            ]);

            try {
                Mail::to($record->user->email)->send(new PaymentStatusChanged($record));

                Log::info('Correo de estado de pago enviado con éxito.', [
                    'email' => $record->user->email,
                    'status' => $record->status,
                    'inscription_id' => $record->id
                ]);
            } catch (\Exception $e) {
                Log::error('Error al enviar el correo de estado de pago.', [
                    'email' => $record->user->email,
                    'status' => $record->status,
                    'inscription_id' => $record->id,
                    'error' => $e->getMessage()
                ]);
            }
        } else {
            Log::info('El estado no ha cambiado, no se enviará correo.', [
                'inscription_id' => $record->id,
                'status' => $record->status
            ]);
        }
    }
}
