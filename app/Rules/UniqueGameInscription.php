<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;

class UniqueGameInscription implements Rule
{
    public function passes($attribute, $value)
    {
        // Verificar si el usuario ya está inscrito en el juego seleccionado
        return !Inscription::where('user_id', Auth::id())
            ->where('game_id', $value)
            ->exists();
    }

    public function message()
    {
        return 'Ya estás inscrito en este juego.';
    }
}
