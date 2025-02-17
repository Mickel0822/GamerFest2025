<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;

class UniqueGameInscription implements Rule
{
    protected $userId;

    public function __construct($userId = null)
    {
        // Si no se pasa un `userId`, usa el ID del usuario autenticado (para InscriptionResource)
        $this->userId = $userId ?? Auth::id();
    }

    public function passes($attribute, $value)
    {
        // Verificar si el usuario ya está inscrito en el juego seleccionado
        return !Inscription::where('user_id', $this->userId)
            ->where('game_id', $value)
            ->exists();
    }

    public function message()
    {
        return 'Este usuario ya está inscrito en este juego.';
    }
}
