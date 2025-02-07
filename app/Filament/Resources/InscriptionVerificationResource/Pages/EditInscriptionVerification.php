<?php

namespace App\Filament\Resources\InscriptionVerificationResource\Pages;

use App\Filament\Resources\InscriptionVerificationResource;
use App\Mail\PaymentStatusChanged;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

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

        // Verifica si el estado ha cambiado antes de enviar el correo
        if ($record->isDirty('status')) {
            Mail::to($record->user->email)->send(new PaymentStatusChanged($record));
        }
    }
}
