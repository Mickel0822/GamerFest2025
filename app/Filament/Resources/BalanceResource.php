<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BalanceResource\Pages;
use App\Models\Expense;
use App\Models\Inscription;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class BalanceResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Balance General';
    protected static ?string $pluralLabel = 'Balance General';
    protected static ?string $singularLabel = 'Balance General';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Reportes';

    public static function table(Table $table): Table
    {
        return $table
            ->query(self::query()) // Usamos una consulta válida
            ->columns([
                TextColumn::make('totalIngresos')
                    ->label('Total Ingresos')
                    ->state(fn () => '$' . number_format(self::getTotalIngresos(), 2))
                    ->sortable(false),

                TextColumn::make('totalEgresos')
                    ->label('Total Egresos')
                    ->state(fn () => '$' . number_format(self::getTotalEgresos(), 2))
                    ->sortable(false),

                TextColumn::make('balanceFinal')
                    ->label('Balance Financiero')
                    ->state(fn () => '$' . number_format(self::getBalanceFinal(), 2))
                    ->sortable(false),
            ]);
    }

    public static function query(): Builder
    {
        // Devuelve una consulta que solo obtiene un único registro
        return Expense::query()->limit(1);
    }

    private static function getTotalIngresos(): float
    {
        return Inscription::where('status', 'verificado')->sum('cost');
    }

    private static function getTotalEgresos(): float
    {
        return Expense::sum('amount');
    }

    private static function getBalanceFinal(): float
    {
        return self::getTotalIngresos() - self::getTotalEgresos();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->role === 'treasurer' || auth()->user()?->role === 'admin';
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBalances::route('/'),
        ];
    }
}
