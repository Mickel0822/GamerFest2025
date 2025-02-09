<?php

namespace App\Filament\Resources\FinancialBalanceResource\Pages;

use App\Filament\Resources\FinancialBalanceResource;
use App\Filament\Resources\BalanceResource;
use Filament\Resources\Pages\Page;
use App\Models\Inscription;
use App\Models\Expense;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class FinancialBalance extends Page
{
    protected static string $resource = FinancialBalanceResource::class;
    protected static ?string $navigationLabel = 'Balance Financiero';
    protected static string $view = 'filament.resources.financial-balance-resource.pages.financial-balance';

    // Función para obtener los datos de ingresos, egresos y saldo total.
    public function getData(): array
    {
        $totalIngresos = Inscription::where('status', 'verificado')->sum('cost');
        $totalEgresos = Expense::sum('amount');
        $saldoTotal = $totalIngresos - $totalEgresos;

        return [
            'ingresos' => mb_convert_encoding(number_format($totalIngresos, 2), 'UTF-8', 'UTF-8'),
            'egresos' => mb_convert_encoding(number_format($totalEgresos, 2), 'UTF-8', 'UTF-8'),
            'saldo' => mb_convert_encoding(number_format($saldoTotal, 2), 'UTF-8', 'UTF-8'),
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
