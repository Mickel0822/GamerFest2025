<?php

namespace App\Filament\Resources\ChangueInscriptionResource\Pages;

use App\Filament\Resources\ChangueInscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateChangueInscription extends CreateRecord
{
    protected static string $resource = ChangueInscriptionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
