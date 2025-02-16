<?php

namespace App\Filament\Resources\ChangueInscriptionResource\Pages;

use App\Filament\Resources\ChangueInscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChangueInscriptions extends ListRecords
{
    protected static string $resource = ChangueInscriptionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
