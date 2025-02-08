<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EarningsDetailResource\Pages;
use App\Filament\Resources\EarningsDetailResource\RelationManagers;
use App\Models\EarningsDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EarningsDetailResource extends Resource
{
    protected static ?string $model = EarningsDetail::class;
    protected static ?string $pluralLabel = 'Gestión de ingreso';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Reportes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListEarningsDetails::route('/'),
            'create' => Pages\CreateEarningsDetail::route('/create'),
            'edit' => Pages\EditEarningsDetail::route('/{record}/edit'),
        ];
    }
}
