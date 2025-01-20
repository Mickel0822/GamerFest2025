<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\GamesWidget;
use App\Filament\Widgets\FinancialReportsWidget;
use App\Filament\Widgets\ActivityReportWidget;  // Asegúrate de que esta línea esté incluida
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.dashboard';

    // Eliminar el enlace de navegación
    protected static ?string $navigationLabel = null;
    protected static ?string $navigationGroup = null;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected function getWidgets(): array
    {
        return [
            ActivityReportWidget::class, // Asegúrate de que este widget esté aquí
            GamesWidget::class, // Reporte de Juegos
            FinancialReportsWidget::class, // Reportes Financieros
        ];
    }
}
