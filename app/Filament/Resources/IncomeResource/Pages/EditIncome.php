<?php

namespace App\Filament\Resources\IncomeResource\Pages;

use App\Filament\Resources\IncomeResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\EditRecord;

class EditIncome extends EditRecord
{
    protected static string $resource = IncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * Get the form schema for this page.
     *
     * @return array
     */
    protected function getFormSchema(): array
    {
        return [
            // Agregando los campos para editar los ingresos
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
                ->placeholder('Seleccione la fecha del ingreso'),
        ];
    }
}
