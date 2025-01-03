<?php

namespace App\Filament\Resources\InscriptionVerificationResource\Pages;

use App\Filament\Resources\InscriptionVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInscriptionVerifications extends ListRecords
{
    protected static string $resource = InscriptionVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
