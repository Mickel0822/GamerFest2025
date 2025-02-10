<?php

namespace App\Filament\Resources\EarningsDetailResource\Pages;

use App\Filament\Resources\EarningsDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEarningsDetails extends ListRecords
{
    protected static string $resource = EarningsDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
