<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use App\Filament\Pages\ParticipantDashboard;
use App\Filament\Widgets\ParticipantDashboard as ParticipantDashboardWidget;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        // Registra los widgets personalizados
        Filament::registerWidgets([
            ParticipantDashboardWidget::class,
        ]);
    }
}


