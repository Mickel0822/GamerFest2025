<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\AccountWidget as BaseWidget;
use App\Models\Inscription;
use App\Models\User;
use App\Models\Game;
use App\Models\Sponsor;

class CustomAccountWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full'; // Ocupa toda la fila

    protected function getUserAvatarUrl(): ?string
    {
        // Usar el accesor avatar_url del modelo User
        return auth()->user()?->avatar_url;
    }

    // Esto hace que los valores estén disponibles en account-widget.blade.php
    protected function getViewData(): array
    {
        $user = auth()->user();

        // Obtener ingresos por inscripciones verificadas
        $ingresoInscripcion = Inscription::where('status', 'verificado')
            ->selectRaw('SUM(cost) as total_income')
            ->value('total_income') ?? 0;

        // Obtener gastos totales
        $expense = Expense::selectRaw('SUM(amount) as total_expense')
            ->value('total_expense') ?? 0;

        // Calcular saldo total (Ingresos - Gastos)
        $saldoTotal = $ingresoInscripcion - $expense;

        return [
            'verifiedGroupGames' => Inscription::where('user_id', $user->id)
                ->where('status', 'verificado')
                ->whereHas('game', function ($query) {
                    $query->where('type', 'grupal');
                })
                ->count(),

            'verifiedIndividualGames' => Inscription::where('user_id', $user->id)
                ->where('status', 'verificado')
                ->whereHas('game', function ($query) {
                    $query->where('type', 'individual');
                })
                ->count(),

            'participantGames' => Inscription::where('status', 'verificado')->count(),
            'userGames' => Game::count(),
            'Sponsors' => Sponsor::count(),
            'ingresoInscripcion' => $ingresoInscripcion,
            'expense' => $expense,
            'saldoTotal' => $saldoTotal, // Ingresos - Gastos
        ];
    }
}