<?php

namespace App\Filament\Resources\RoundResource\Pages;

use App\Filament\Resources\RoundResource;
use App\Models\Inscription;
use App\Models\Result;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRound extends CreateRecord
{
    protected static string $resource = RoundResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Obtener el juego asignado al coordinador actual
        $game = auth()->user()->game;

        // Agregar el game_id al formulario
        $data['game_id'] = $game->id;

        return $data;
    }

    protected function afterCreate(): void
    {
        $round = $this->record;

        // Obtener participantes activos del juego asociado
        $participants = Inscription::where('game_id', $round->game_id)
            ->active()
            ->pluck('id') // IDs de inscripciones (individuales o grupales)
            ->shuffle();

        // Crear enfrentamientos
        $pairs = $participants->chunk(2);
        foreach ($pairs as $pair) {
            if ($pair->count() === 2) {
                Result::create([
                    'round_id' => $round->id,
                    'game_id' => $round->game_id,
                    'player_one_id' => $pair->first(),
                    'player_two_id' => $pair->last(),
                    'match_type' => $round->game->type, // 'individual' o 'group'
                ]);
            } else {
                // Caso impar: pasa automáticamente
                Result::create([
                    'round_id' => $round->id,
                    'game_id' => $round->game_id,
                    'player_one_id' => $pair->first(),
                    'winner_type' => $round->game->type === 'individual' ? 'player' : 'team', // Verifica el tipo de juego
                    'winner_id' => $pair->first(),
                    'match_type' => $round->game->type,
                ]);
            }
        }
    }
}
