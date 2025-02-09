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

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Lista de Auspiciantes';
    protected static ?string $pluralLabel = 'Lista de Auspiciantes';
    protected static ?string $singularLabel = 'Lista de Auspiciantes';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Reportes';


    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                 ->label('Nombre del Patrocinador')
                ->searchable(),
            Tables\Columns\ImageColumn::make('image_url')
                ->label('URL de la Imagen'),

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
