<?php

namespace App\Filament\Resources\InscriptionVerificationResource\Pages;

use App\Filament\Resources\InscriptionVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInscriptionVerification extends EditRecord
{
    protected static string $resource = InscriptionVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
