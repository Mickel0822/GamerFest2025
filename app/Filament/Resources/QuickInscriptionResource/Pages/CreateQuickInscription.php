<?php

namespace App\Filament\Resources\QuickInscriptionResource\Pages;

use App\Filament\Resources\QuickInscriptionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuickInscription extends CreateRecord
{
    protected static string $resource = QuickInscriptionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'verificado'; // Aseguramos que el estado sea "verificado".
        return $data;
    }
}
