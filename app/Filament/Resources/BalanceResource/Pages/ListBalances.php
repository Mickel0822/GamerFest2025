<?php

namespace App\Filament\Resources\BalanceResource\Pages;

use App\Filament\Resources\BalanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use App\Models\Expense;
use App\Models\Inscription;

class ListBalances extends ListRecords
{
    protected static string $resource = BalanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportToPdf')
                ->label('Exportar Balance a PDF')
                ->icon('heroicon-o-document-text')
                ->action(fn () => $this->exportToPdf()),
        ];
    }

    public function exportToPdf()
    {
        // Obtener los datos del balance general
        $totalIngresos = Inscription::where('status', 'verificado')->sum('cost');
        $totalEgresos = Expense::sum('amount');
        $balanceFinal = $totalIngresos - $totalEgresos;

        // Pasar los datos a la vista del PDF
        $pdf = Pdf::loadView('exports.balance-report', compact('totalIngresos', 'totalEgresos', 'balanceFinal'));

        // Descargar el PDF
        return response()->streamDownload(
            fn () => print($pdf->output()),
            'balance_general.pdf'
        );
    }
}
