<?php

namespace App\Filament\Resources\EgressDetailResource\Pages;

use App\Filament\Resources\EgressDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEgressDetails extends ListRecords
{
    protected static string $resource = EgressDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
