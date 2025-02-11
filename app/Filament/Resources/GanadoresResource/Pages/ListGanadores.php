<?php

namespace App\Filament\Resources\GanadoresResource\Pages;

use App\Filament\Resources\GanadoresResource;
use Filament\Resources\Pages\ListRecords;
use App\Models\Result;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;

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

    public function exportToPdf()
    {
        // Obtener la consulta de la tabla con los filtros aplicados
        $ganadores = $this->getFilteredTableQuery()
            ->with(['game', 'playerOne.user', 'playerTwo.user', 'winner.user'])
            ->get();

        // Generar el PDF con la vista
        $pdf = Pdf::loadView('exports.ganadores-list', compact('ganadores'));

        // Descargar el PDF
        return response()->streamDownload(
            fn () => print($pdf->output()),
            'lista_ganadores.pdf'
        );
    }
}
