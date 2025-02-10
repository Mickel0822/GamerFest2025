<?php

namespace App\Filament\Resources\EgressDetailResource\Pages;

use App\Filament\Resources\EgressDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEgressDetail extends EditRecord
{
    protected static string $resource = EgressDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
