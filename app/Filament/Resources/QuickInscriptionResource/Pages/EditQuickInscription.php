<?php

namespace App\Filament\Resources\QuickInscriptionResource\Pages;

use App\Filament\Resources\QuickInscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuickInscription extends EditRecord
{
    protected static string $resource = QuickInscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
