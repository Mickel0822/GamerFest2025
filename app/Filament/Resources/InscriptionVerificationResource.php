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
use Illuminate\Support\Facades\Storage;

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
                Select::make('user_id')
                    ->label('Participante')
                    ->relationship('user', 'name') // Carga la relación y muestra el nombre del usuario
                    ->disabled(), // Deshabilita el campo para que no sea editable

                Select::make('game_id')
                    ->label('Juego')
                    ->relationship('game', 'name') // Carga la relación y muestra el nombre del juego
                    ->disabled(), // Deshabilita el campo para que no sea editable

                TextInput::make('cost')
                    ->label('Costo')
                    ->default(fn ($record) => $record?->cost) // Obtiene el costo
                    ->disabled(),
            ])
            ->columnSpan('full'),

           // Sección: Comprobante de Pago
           Section::make('Comprobante de Pago')
            ->schema([
                // Campo del número de comprobante
                TextInput::make('receipt_number')
                    ->label('Número de Comprobante')
                    ->default(fn ($record) => $record?->receipt_number) // Muestra el valor actual
                    ->disabled(),

                Forms\Components\ViewField::make('payment_receipt_preview')
                    ->view('components.image-preview') // La vista personalizada que usas
                    ->viewData([
                        'image_url' => request()->route()->parameter('record')
                            ? (Inscription::find(request()->route()->parameter('record'))?->payment_receipt
                                ? Storage::disk('s3')->url(Inscription::find(request()->route()->parameter('record'))?->payment_receipt)
                                : null)
                            : null,
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
                ImageColumn::make('payment_receipt')
                ->label('Comprobante de Pago')
                ->disk('s3') // Indica que se usa S3
                ->getStateUsing(fn ($record) => $record->payment_receipt
                    ? Storage::disk('s3')->url($record->payment_receipt)
                    : null
                )
                ->size(50), // Abre el enlace en una nueva pestaña
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
