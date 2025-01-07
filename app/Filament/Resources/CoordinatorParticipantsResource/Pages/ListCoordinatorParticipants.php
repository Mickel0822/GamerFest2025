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
        // Solo muestra inscripciones del juego asignado al coordinador
        $gameId = auth()->user()?->game?->id;

        return parent::getTableQuery()
            ->where('game_id', $gameId) // Filtrar por el juego asignado al coordinador
            ->with(['game', 'teamMembers.user']); // Cargar relaciones necesarias
    }

}
