<?php

namespace App\Filament\Resources\ChangueInscriptionResource\Pages;

use App\Filament\Resources\ChangueInscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChangueInscription extends EditRecord
{
    protected static string $resource = ChangueInscriptionResource::class;

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
}
