<?php

namespace App\Filament\Resources\EgresosResource\Pages;

use App\Filament\Resources\EgresosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use App\Models\Expense;

class ListEgresos extends ListRecords
{
    protected static string $resource = EgresosResource::class;

    protected function getHeaderActions(): array
    {
        $totalEgresos = Expense::sum('amount'); // ✅ Calcula la suma total de egresos

        return [
            Action::make('totalEgresos')
                ->label('Total Egresos: $' . number_format($totalEgresos, 2))
                ->color('info')
                ->disabled(), // ❌ No es un botón clickeable, solo informativo

            Action::make('exportToPdf')
                ->label('Exportar Egresos a PDF')
                ->icon('heroicon-o-document-text')
                ->action(fn () => $this->exportToPdf()),
        ];
    }

    public function exportToPdf()
    {
        // Obtener todos los egresos y la suma total
        $egresos = Expense::all();
        $totalEgresos = Expense::sum('amount');

        // Generar el PDF con la vista
        $pdf = Pdf::loadView('exports.egresos-report', compact('egresos', 'totalEgresos'));

        // Descargar el PDF
        return response()->streamDownload(
            fn () => print($pdf->output()),
            'lista_egresos.pdf'
        );
    }
}
