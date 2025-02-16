<?php

namespace App\Filament\Widgets;

use App\Models\Inscription;
use App\Models\Income;
use App\Models\Expense;
use Filament\Widgets\Widget;

class TreasurerWidget extends Widget
{
    protected static string $view = 'filament.widgets.treasurer-widget';

    // Hacer que el widget ocupe toda la fila

    public $totalInscriptions;
    public $verified;
    public $pendingAmount;
    public $pending;
    public $rejected;
    public $totalRevenue;
    public $totalIncome;
    public $totalExpenses;
    public $saldo;
    public $goal;
    public $progress;

    /**
     * Restricción de visualización del widget
     */
    public static function canView(): bool
    {
        return auth()->user()?->role === 'treasurer';
    }

    /**
     * Calcula los datos necesarios para la vista.
     */
    public function mount()
    {
        $this->totalInscriptions = Inscription::count();
        $this->verified = Inscription::where('status', Inscription::STATUS_VERIFIED)->count();
        $this->pending = Inscription::where('status', Inscription::STATUS_PENDING)->count();
        $this->rejected = Inscription::where('status', Inscription::STATUS_REJECTED)->count();

        $this->totalRevenue = Inscription::where('status', Inscription::STATUS_VERIFIED)->sum('cost');

        // Calcula el total de dinero pendiente**
        $this->pendingAmount = Inscription::where('status', Inscription::STATUS_PENDING)->sum('cost');
        
        // Sumar el total de los ingresos registrados
        $this->totalIncome = Income::sum('amount');

        //  Sumar el total de los egresos registrados
        $this->totalExpenses = Expense::sum('amount');

        // Calcular el saldo
        $this->saldo = $this->totalIncome - $this->totalExpenses;
       
        $this->goal = 500; // Puedes ajustar este valor
        $this->progress = $this->goal > 0
            ? round(($this->totalRevenue / $this->goal) * 100, 2)
            : 0;
    }
}
