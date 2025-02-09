<?php

namespace App\Filament\Resources\IngresosResource\Pages;

use App\Filament\Resources\IngresosResource;
use App\Models\Inscription;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class ListIngresos extends ListRecords
{
    protected static string $resource = IngresosResource::class;

    protected function getHeaderActions(): array
    {
        // ✅ Solo suma los ingresos verificados
        $totalIngresos = Inscription::where('status', 'verificado')->sum('cost');

        return [
            Action::make('totalIngresos')
                ->label('Total Ingresos: $' . number_format($totalIngresos, 2))
                ->color('info')
                ->disabled(), // ❌ Solo informativo, no clickeable

            Action::make('exportToPdf')
                ->label('Exportar Inscripciones a PDF')
                ->icon('heroicon-o-document-text')
                ->action(fn () => $this->exportToPdf()),
        ];
    }

    // ✅ Filtrar solo los participantes con comprobantes verificados en la tabla
    protected function getTableQuery(): ?Builder
    {
        return Inscription::query()->where('status', 'verificado');
    }

    public function exportToPdf()
    {
        // ✅ Filtra solo los ingresos verificados en el PDF
        $ingresos = Inscription::where('status', 'verificado')->get();
        $totalIngresos = Inscription::where('status', 'verificado')->sum('cost');

        // Generar el PDF con la vista
        $pdf = Pdf::loadView('exports.ingresos-report', compact('ingresos', 'totalIngresos'));

        // Descargar el PDF
        return response()->streamDownload(
            fn () => print($pdf->output()),
            'lista_ingresos.pdf'
        );
    }
}
