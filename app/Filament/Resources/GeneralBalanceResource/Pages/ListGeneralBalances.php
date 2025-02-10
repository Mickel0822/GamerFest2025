<?php

namespace App\Filament\Resources\GeneralBalanceResource\Pages;

use App\Filament\Resources\GeneralBalanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGeneralBalances extends ListRecords
{
    protected static string $resource = GeneralBalanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
