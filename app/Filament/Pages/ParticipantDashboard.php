<?php
/*
namespace App\Filament\Pages;

use Filament\Pages\Page;

class ParticipantDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static string $view = 'filament.pages.participant-dashboard';

    public function getViewData(): array
    {
        $userId = auth()->id();

        return [
            'pending' => Inscription::where('user_id', $userId)->where('status', 'pendiente')->with('game')->get(),
            'verified' => Inscription::where('user_id', $userId)->where('status', 'verificado')->with('game')->get(),
            'rejected' => Inscription::where('user_id', $userId)->where('status', 'rechazado')->with('game')->get(),
        ];
    }
}
*/