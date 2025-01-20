<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscriptionVerificationResource\Pages;
use App\Filament\Resources\InscriptionVerificationResource\RelationManagers;
use App\Models\Inscription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;

class InscriptionVerificationResource extends Resource
{
    protected static ?string $model = Inscription::class;
    protected static ?string $pluralLabel = 'Verificación Pagos';
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationGroup = 'Gestion Tesorero';

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form->schema([
            //Sección: Datos del Participante
            Section::make('Datos del Participante')
                ->schema([
                    TextInput::make('user_id')
                        ->label('Participante')
                        ->default(fn ($record) => $record->user?->name)
                        ->disabled(),

                    TextInput::make('game_id')
                        ->label('Juego')
                        ->default(fn ($record) => $record->game?->name)
                        ->disabled(),

                    TextInput::make('cost')
                        ->label('Costo')
                        ->disabled(),
                ])
                ->columnSpan('full') // Ocupa todo el ancho
                , // Encabezado de la sección

            // Sección: Comprobante de Pago
           // Sección: Comprobante de Pago
           Section::make('Comprobante de Pago')
                ->schema([
                    Forms\Components\ViewField::make('payment_receipt_preview')
                        ->view('components.image-preview')
                        ->viewData([
                            'image_url' => request()->route()->parameter('record')
                                ? asset('storage/' . Inscription::find(request()->route()->parameter('record'))?->payment_receipt ?? '')
                                : '',
                        ]),
                ]),

            // Campo: Estado del Pago
            Select::make('status')
                ->label('Estado del Pago')
                ->options([
                    Inscription::STATUS_PENDING => 'Pendiente',
                    Inscription::STATUS_VERIFIED => 'Verificado',
                    Inscription::STATUS_REJECTED => 'Rechazado',
                ])
                ->required(),
        ]);
    }



    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('user.name')->label('Participante'),
            TextColumn::make('game.name')->label('Juego'),
            TextColumn::make('cost')->label('Costo')->money('USD'),
            BadgeColumn::make('status')
                ->label('Estado')
                ->colors([
                    'warning' => 'pendiente',
                    'success' => 'verificado',
                    'danger' => 'rechazado',
                ]),
                TextColumn::make('payment_receipt')
                    ->label('Comprobante')
                    ->formatStateUsing(fn () => 'Ver Comprobante') // El texto que se mostrará
                    ->url(fn ($record) => asset('storage/' . $record->payment_receipt)) // URL de la imagen
                    ->openUrlInNewTab(), // Abre el enlace en una nueva pestaña
        ])
        ->actions([
            Tables\Actions\EditAction::make()->label('Verificar Pago'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->label('Estado del Pago')
                ->options([
                    Inscription::STATUS_PENDING => 'Pendiente',
                    Inscription::STATUS_VERIFIED => 'Verificado',
                    Inscription::STATUS_REJECTED => 'Rechazado',
                ]),
        ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canViewAny(): bool
    {
    return auth()->user()?->role === 'treasurer';
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInscriptionVerifications::route('/'),
            //'create' => Pages\CreateInscriptionVerification::route('/create'),
            'edit' => Pages\EditInscriptionVerification::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
