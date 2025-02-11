<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use App\Filament\Pages\ParticipantDashboard;
use App\Filament\Widgets\ParticipantDashboard as ParticipantDashboardWidget;

use Illuminate\Support\Facades\App;


class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        // Registra los widgets personalizados
        Filament::registerWidgets([
            ParticipantDashboardWidget::class,
        ]);



        App::setLocale('es'); // Forzar el idioma de Laravel
    }
}


