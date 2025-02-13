<?php

namespace App\Filament\Widgets;

use Filament\Widgets\AccountWidget as BaseWidget;
use App\Models\Inscription;

class CustomAccountWidget extends BaseWidget
{
    protected function getUserAvatarUrl(): ?string
    {
        // Usar el accesor avatar_url del modelo User
        return auth()->user()?->avatar_url;
    }

    //Esto hace que verifiedGroupGames y verifiedIndividualGames estén disponibles en account-widget.blade.php.
    protected function getViewData(): array
    {
        $user = auth()->user();

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
        ];
    }

}



    
