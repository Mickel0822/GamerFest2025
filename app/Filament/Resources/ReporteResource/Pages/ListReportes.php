<?php

namespace App\Filament\Resources\ReporteResource\Pages;

use App\Filament\Resources\ReporteResource;
use Filament\Resources\Pages\ListRecords;
use App\Models\Inscription;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;

class ListReportes extends ListRecords
{
    protected static string $resource = ReporteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportToPdf')
                ->label('Exportar Inscritos a PDF')
                ->icon('heroicon-o-document-text')
                ->action(fn () => $this->exportToPdf()),
        ];
    }

    public function exportToPdf()
    {
        // Obtener la consulta de la tabla con los filtros aplicados
        $inscriptions = $this->getFilteredTableQuery()->with(['user', 'game'])->get();

        // Generar el PDF con la vista
        $pdf = Pdf::loadView('exports.inscriptions-list', compact('inscriptions'));

        // Descargar el PDF
        return response()->streamDownload(
            fn () => print($pdf->output()),
            'lista_inscritos.pdf'
        );
    }
}
