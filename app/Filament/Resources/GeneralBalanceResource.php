<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeneralBalanceResource\Pages;
use App\Filament\Resources\GeneralBalanceResource\RelationManagers;
use App\Models\GeneralBalance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GeneralBalanceResource extends Resource
{
    protected static ?string $model = GeneralBalance::class;
    protected static ?string $pluralLabel = 'Balance general';
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
            'index' => Pages\ListGeneralBalances::route('/'),
            'create' => Pages\CreateGeneralBalance::route('/create'),
            'edit' => Pages\EditGeneralBalance::route('/{record}/edit'),
        ];
    }
}
