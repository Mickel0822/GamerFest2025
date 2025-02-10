<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoundResource\Pages;
use App\Filament\Resources\RoundResource\RelationManagers;
use App\Models\Round;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Inscription;
use App\Models\Result;

class RoundResource extends Resource
{
    protected static ?string $model = Round::class;

    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';

    protected static ?string $navigationGroup = 'Gestión de Coordinador';

    protected static ?string $navigationLabel = 'Enfrentamientos';

    protected static ?string $pluralLabel = 'Enfretamientos';
    protected static ?string $singularLabel = 'Enfrentamiento';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->label('Nombre de la Ronda')->required(),
            TextInput::make('order')->label('Orden')->numeric()->required(),
            TextInput::make('type')
                ->label('Tipo de Ronda')
                ->default('normal') // Por defecto, puedes personalizar
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Nombre de la Ronda'),
            TextColumn::make('game.name')->label('Juego'),
            TextColumn::make('order')->label('Orden')->sortable(),
            TextColumn::make('type')->label('Tipo de Ronda'),
        ]);
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'coordinator';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRounds::route('/'),
            'create' => Pages\CreateRound::route('/create'),
            'edit' => Pages\EditRound::route('/{record}/edit'),
        ];
    }
}
