<?php

namespace App\Filament\Resources\AuspiciantesResource\Pages;

use App\Filament\Resources\AuspiciantesResource;
use Filament\Resources\Pages\ListRecords;
use App\Models\Sponsor;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;

class ListAuspiciantes extends ListRecords
{
    protected static string $resource = AuspiciantesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportToPdf')
                ->label('Exportar Auspiciantes a PDF')
                ->icon('heroicon-o-document-text')
                ->action(fn () => $this->exportToPdf()),
        ];
    }

    public function exportToPdf()
    {
        // Obtener todos los auspiciantes sin filtros
        $sponsors = Sponsor::all();

        // Generar el PDF con la vista
        $pdf = Pdf::loadView('exports.sponsors-list', compact('sponsors'));

        // Descargar el PDF
        return response()->streamDownload(
            fn () => print($pdf->output()),
            'lista_auspiciantes.pdf'
        );
    }
}
