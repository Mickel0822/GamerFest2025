<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use App\Filament\Pages\ParticipantDashboard;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Registra la página personalizada
        Filament::registerPages([
            ParticipantDashboard::class,
        ]);
    }
}


