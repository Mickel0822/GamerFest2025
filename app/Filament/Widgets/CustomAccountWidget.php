<?php

namespace App\Filament\Widgets;

use Filament\Widgets\AccountWidget as BaseWidget;

class CustomAccountWidget extends BaseWidget
{
    protected function getUserAvatarUrl(): ?string
    {
        // Usar el accesor avatar_url del modelo User
        return auth()->user()?->avatar_url;
    }
}
