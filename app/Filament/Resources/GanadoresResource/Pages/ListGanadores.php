<?php

namespace App\Filament\Resources\GanadoresResource\Pages;

use App\Filament\Resources\GanadoresResource;
use Filament\Resources\Pages\ListRecords;
use App\Models\GameWinner;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class ListGanadores extends ListRecords
{
    protected static string $resource = GanadoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportToPdf')
                ->label('Exportar Ganadores a PDF')
                ->icon('heroicon-o-document-text')
                ->action(fn () => $this->exportToPdf()),
        ];
    }

    /**
     * Filtrar los registros según el rol del usuario
     */
    protected function getTableQuery(): Builder
    {
        $query = GameWinner::query()->with(['game']);

        if (auth()->user()?->role === 'coordinator') {
            $gameId = auth()->user()?->game?->id;
            $query->where('game_id', $gameId);
        }

        return $query;
    }

    public function exportToPdf()
    {
        $ganadores = $this->getFilteredTableQuery()
            ->with(['game']) // Solo traemos el nombre del juego
            ->get();

        $pdf = Pdf::loadView('exports.ganadores-list', compact('ganadores'));

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'lista_ganadores.pdf'
        );
    }
}
