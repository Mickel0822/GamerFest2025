<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinancialBalanceResource\Pages;
use Filament\Resources\Resource;

class FinancialBalanceResource extends Resource
{
    protected static ?string $model = null; // No se requiere un modelo específico
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Balance General';
    protected static ?string $pluralLabel = 'Balance General';
    protected static ?string $singularLabel = 'Balance General';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Reportes';

    /*
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
    */


    //public static function canViewAny(): bool
    //{
        //return auth()->user()?->role === 'treasurer' || auth()->user()->role === 'admin';
    //}

    public static function shouldRegisterNavigation(): bool
    {
        // Solo mostrar en el menú si el usuario tiene el rol de tesorero.
        return auth()->user()?->role === 'treasurer' or auth()->user()?->role === 'admin';
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
            'index' => Pages\FinancialBalance::route('/'),
            //'create' => Pages\CreateFinancialBalance::route('/create'),
            //'edit' => Pages\EditFinancialBalance::route('/{record}/edit'),
        ];
    }
}
