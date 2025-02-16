<?php

namespace App\Filament\Resources\CoordinatorParticipantsResource\Pages;

use App\Filament\Resources\CoordinatorParticipantsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCoordinatorParticipants extends ListRecords
{
    protected static string $resource = CoordinatorParticipantsResource::class;

    protected function getTableQuery(): ?Builder
    {
        // Obtener el ID del juego asignado al coordinador actual
        $gameId = auth()->user()?->game?->id;

        return parent::getTableQuery()
            ->where('game_id', $gameId) // Filtrar por el juego asignado al coordinador
            ->where('status', 'verificado') // Solo mostrar participantes verificados
            ->with(['game', 'teamMembers.user']); // Cargar relaciones necesarias
    }


}
