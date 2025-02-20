<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuspiciantesResource\Pages;
use App\Filament\Resources\AuspiciantesResource\RelationManagers;
use App\Models\Sponsor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AuspiciantesResource extends Resource
{
    protected static ?string $model = Sponsor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationLabel = 'Lista de Auspiciantes';
    protected static ?string $pluralLabel = 'Lista de Auspiciantes';
    protected static ?string $singularLabel = 'Lista de Auspiciantes';
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationGroup = 'Reportes';


    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image_url')
            ->label('Logo del Patrocinador'),
            Tables\Columns\TextColumn::make('name')
                 ->label('Nombre del Patrocinador')
                ->searchable(),
            Tables\Columns\TextColumn::make('description') // Agregamos la descripción
                ->label('Descripción')
                ->limit(50) // Opcional: Limita la cantidad de caracteres mostrados en la tabla
                ->wrap(),

        ]);
    }

    public static function canViewAny(): bool
    {
    return auth()->user()?->role === 'admin';
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuspiciantes::route('/'),
        ];
    }
}
