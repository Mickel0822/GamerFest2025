<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngresosResource\Pages;
use App\Models\Inscription;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class IngresosResource extends Resource
{
    protected static ?string $model = Inscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Detalle de Ingresos';
    protected static ?string $pluralLabel = 'Detalle de Ingresos';
    protected static ?string $singularLabel = 'Detalle de Ingresos';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Reportes';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Nombre'),
                Tables\Columns\TextColumn::make('user.last_name')->label('Apellido'),
                Tables\Columns\TextColumn::make('user.email')->label('Correo Electrónico'),
                Tables\Columns\TextColumn::make('cost')->label('Costo'),
            ])
            ->filters([])
            ->groups([
                Tables\Grouping\Group::make('payment_method')
                    ->label('Inscritos en')
                    ->getTitleFromRecordUsing(fn (Inscription $record) => match ($record->payment_method) {
                        'cash' => 'Efectivo',
                        'comprobante' => 'Web',
                        default => 'Otros',
                    }),
            ]);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->role === 'treasurer' || auth()->user()?->role === 'admin';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIngresos::route('/'),
        ];
    }
}
