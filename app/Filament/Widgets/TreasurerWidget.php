<?php

namespace App\Filament\Widgets;

use App\Models\Inscription;
use Filament\Widgets\Widget;

class TreasurerWidget extends Widget
{
    protected static string $view = 'filament.widgets.treasurer-widget';

    // Hacer que el widget ocupe toda la fila

    public $totalInscriptions;
    public $verified;
    public $pending;
    public $rejected;
    public $totalRevenue;
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

        $this->goal = 500; // Puedes ajustar este valor
        $this->progress = $this->goal > 0
            ? round(($this->totalRevenue / $this->goal) * 100, 2)
            : 0;
    }
}
