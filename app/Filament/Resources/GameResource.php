<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameResource\Pages;
use App\Filament\Resources\GameResource\RelationManagers;
use App\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece'; // Ícono del menú
    protected static ?string $navigationLabel = 'Juegos';
    protected static ?string $pluralLabel = 'Juegos';
    protected static ?string $singularLabel = 'Juego';
    protected static ?int $navigationSort = 2; // Cambia el orden
    protected static ?string $navigationGroup = 'Gestión de Juegos'; // Grupo del menú


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nombre del Juego')
                ->required(),
            Forms\Components\Select::make('type')
                ->label('Tipo de Juego')
                ->options([
                    'individual' => 'Individual',
                    'group' => 'Grupal',
                ])
                ->required(),
            Forms\Components\Select::make('status')
                ->label('Estado')
                ->options([
                    'activo' => 'Activo',
                    'pausado' => 'Pausado',
                    'finalizado' => 'Finalizado',
                ])
                ->default('activo')
                ->required(),
            Forms\Components\Textarea::make('rules')
                ->label('Reglas del Juego')
                ->rows(4),
            Forms\Components\Textarea::make('results')
                ->label('Resultados')
                ->rows(4),
            Forms\Components\TextInput::make('image_url')
                ->label('URL de la Imagen')
                ->url() // Valida que sea una URL válida
                ->placeholder('https://example.com/image.jpg'),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tipo')
                    ->colors([
                        'success' => 'group',
                        'warning' => 'individual',
                    ])
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'individual' => 'Individual',
                            'group' => 'Grupal',
                            default => $state,
                        };
                    }),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Estado')
                    ->colors([
                        'success' => 'activo',
                        'warning' => 'pausado',
                        'danger' => 'finalizado',
                    ])
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'activo' => 'Activo',
                            'pausado' => 'Pausado',
                            'finalizado' => 'Finalizado',
                            default => $state,
                        };
                    }),
                Tables\Columns\ImageColumn::make('image_url') // Columna para la imagen
                    ->label('Imagen del Juego')
                    ->circular(), // Imagen redondeada
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
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
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }
}
