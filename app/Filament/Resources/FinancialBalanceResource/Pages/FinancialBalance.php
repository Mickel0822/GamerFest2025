<?php

namespace App\Filament\Resources\FinancialBalanceResource\Pages;

use App\Filament\Resources\FinancialBalanceResource;
use Filament\Resources\Pages\Page;
use App\Models\Inscription;
use App\Models\Expense;
use Barryvdh\DomPDF\Facade\Pdf;

class FinancialBalance extends Page
{
    protected static string $resource = FinancialBalanceResource::class;
    protected static ?string $navigationLabel = 'Balance Financiero';
    protected static ?string $title = 'Balance Financiero';
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

    // Función para exportar el balance a PDF.
    public function exportToPdf()
    {
        $data = $this->getData();

        // Asegúrate de que los datos sean válidos y estén codificados en UTF-8
        foreach ($data as $key => $value) {
            if (is_string($value) && !mb_check_encoding($value, 'UTF-8')) {
                $data[$key] = utf8_encode($value);
            }
        }

        // Generar el PDF usando la vista
        $pdf = Pdf::loadView('exports.financial-balance', compact('data'));

        // Forzar la descarga del PDF
        return response()->streamDownload(
            fn () => print($pdf->output()),
            'balance_financiero.pdf'
        );
    }


}
