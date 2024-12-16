<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 4; // Cambia el orden
    protected static ?string $navigationGroup = 'Gestion Usuarios';
    protected static ?string $navigationLabel = 'Usuarios';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nombre')
                ->required()
                ->placeholder('Nombre del Usuario'),
            Forms\Components\TextInput::make('last_name')
                ->label('Apellido')
                ->required()
                ->placeholder('Apellido del Usuario'),
            Forms\Components\TextInput::make('email')
                ->label('Correo Electrónico')
                ->email()
                ->required(),
            Forms\Components\Select::make('university')
                ->label('Universidad')
                ->options([
                    'Universidad A' => 'Universidad A',
                    'Universidad B' => 'Universidad B',
                    'Universidad C' => 'Universidad C',
                    'Universidad D' => 'Universidad D',
                ])
                ->required(),
            Forms\Components\Select::make('role')
                ->label('Rol')
                ->options([
                    'admin' => 'Administrador Principal',
                    'coordinator' => 'Coordinador de Juegos',
                    'treasurer' => 'Tesorero',
                    'participant' => 'Participante',
                ])
                ->required(),
            Forms\Components\TextInput::make('password')
                ->label('Contraseña')
                ->password()
                ->required(fn (string $context): bool => $context === 'create')
                ->dehydrateStateUsing(fn ($state) => bcrypt($state)),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre'),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Apellido'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo Electrónico'),
                Tables\Columns\BadgeColumn::make('university')
                    ->label('Universidad'),
                Tables\Columns\BadgeColumn::make('role')
                    ->label('Rol')
                    ->colors([
                        'success' => 'admin',
                        'warning' => 'coordinator',
                        'primary' => 'treasurer',
                        'info' => 'participant',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Rol')
                    ->options([
                        'admin' => 'Administrador Principal',
                        'coordinator' => 'Coordinador de Juegos',
                        'treasurer' => 'Tesorero',
                        'participant' => 'Participante',
                    ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}