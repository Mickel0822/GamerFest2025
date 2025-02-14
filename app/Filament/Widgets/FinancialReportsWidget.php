<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use App\Models\Inscription;
use Filament\Widgets\Widget;
use Illuminate\View\View;

class FinancialReportsWidget extends Widget
{
    protected static string $view = 'filament.widgets.financial-reports-widget';
    protected int|string|array $columnSpan = 'full'; // Ocupa toda la fila

    public static function canView(): bool
    {
        return auth()->user()?->role === null;
    }

    public function render(): View
    {
        // Calcular los ingresos totales
        $totalIncomes = Inscription::where('status', 'verificado')->sum('cost');

        // Calcular los egresos totales
        $totalExpenses = Expense::sum('amount');

        // Calcular el balance general
        $generalBalance = $totalIncomes - $totalExpenses;

        // Calcular ingresos por juego
        $incomesByGame = Inscription::where('inscriptions.status', 'verificado')  // Especificar la tabla 'inscriptions'
            ->join('games', 'games.id', '=', 'inscriptions.game_id')  // Unimos con la tabla de juegos
            ->groupBy('games.name')  // Agrupamos por nombre de juego
            ->selectRaw('games.name as game_name, SUM(inscriptions.cost) as total_income')  // Seleccionamos el nombre del juego
            ->get()
            ->pluck('total_income', 'game_name'); // Obtenemos los ingresos por juego usando el nombre del juego



        // Calcular ingresos por participante (mostrando nombre del participante)
        $incomesByParticipant = Inscription::where('inscriptions.status', 'verificado')  // Especificar la tabla 'inscriptions'
            ->join('users', 'users.id', '=', 'inscriptions.user_id') // Unir con la tabla users
            ->groupBy('users.name')  // Agrupar por nombre de usuario
            ->selectRaw('users.name as participant_name, SUM(inscriptions.cost) as total_income') // Seleccionamos el nombre del participante
            ->get()
            ->pluck('total_income', 'participant_name'); // Obtener el nombre del participante


        // Calcular ingresos por fecha
        $incomesByDate = Inscription::where('status', 'verificado')
            ->groupBy('created_at')
            ->selectRaw('DATE(created_at) as date, SUM(cost) as total_income')
            ->get()
            ->pluck('total_income', 'date');

        // Calcular ingresos por método de pago
        $incomesByPaymentMethod = Inscription::where('status', 'verificado')
            ->groupBy('payment_method')
            ->selectRaw('payment_method, SUM(cost) as total_income')
            ->get()
            ->pluck('total_income', 'payment_method');

        // Pasar los datos a la vista
        return view(self::$view, [
            'totalIncomes' => $totalIncomes,
            'totalExpenses' => $totalExpenses,
            'generalBalance' => $generalBalance,
            'incomesByGame' => $incomesByGame,
            'incomesByParticipant' => $incomesByParticipant,
            'incomesByDate' => $incomesByDate,
            'incomesByPaymentMethod' => $incomesByPaymentMethod
        ]);
    }
}


