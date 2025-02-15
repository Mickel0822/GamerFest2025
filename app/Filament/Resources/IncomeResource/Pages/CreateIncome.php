<?php

namespace App\Filament\Resources\IncomeResource\Pages;

use App\Filament\Resources\IncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIncome extends CreateRecord
{
    protected static string $resource = IncomeResource::class;
    /**
     * Get the form schema for this page.
     *
     * @return array
     */
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('description')
                ->label('Descripción')
                ->required()
                ->placeholder('Ingrese la descripción del ingreso'),

            Forms\Components\TextInput::make('amount')
                ->label('Monto')
                ->numeric()
                ->required()
                ->placeholder('Ejemplo: 100.00'),

            Forms\Components\DatePicker::make('date')
                ->label('Fecha')
                ->required()
                ->default(now()->format('Y-m-d')) // Fecha actual por defecto
                ->placeholder('Seleccione la fecha del ingreso'),
        ];
    }
}
