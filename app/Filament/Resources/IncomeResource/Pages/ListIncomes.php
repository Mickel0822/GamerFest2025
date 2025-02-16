<?php

namespace App\Filament\Resources\IncomeResource\Pages;

use App\Filament\Resources\IncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;

class ListIncomes extends ListRecords
{
    protected static string $resource = IncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('description')
                ->label('Descripción')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('amount')
                ->label('Monto')
                ->sortable()
                ->formatStateUsing(fn ($state) => '$' . number_format($state, 2)), // Formato de dinero

            Tables\Columns\TextColumn::make('date')
                ->label('Fecha')
                ->sortable()
                ->date()
                ->format('d-m-Y'),
        ];
    }
}