<?php

namespace App\Filament\Resources\CoordinatorParticipantsResource\Pages;

use App\Filament\Resources\CoordinatorParticipantsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoordinatorParticipants extends EditRecord
{
    protected static string $resource = CoordinatorParticipantsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
