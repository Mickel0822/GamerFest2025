<?php

namespace App\Filament\Resources\ResultResource\Pages;

use App\Filament\Resources\ResultResource;
use App\Models\GameWinner;
use App\Models\Inscription;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResult extends EditRecord
{
    protected static string $resource = ResultResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $result = $this->record;
        $round = $result->round;

        // Determinar el tipo de ganador basado en el tipo de juego
        $data['winner_type'] = $result->match_type === 'individual' ? 'player' : 'team';

        // Obtener el ID del perdedor
        $loserId = $result->player_one_id == $data['winner_id'] ? $result->player_two_id : $result->player_one_id;

        // Marcar al perdedor como eliminado
        Inscription::where('id', $loserId)->update(['is_eliminated' => true]);

        // Si es la final, guardar los 3 primeros lugares en `game_winners`
        if ($round->type === 'final') {
            GameWinner::updateOrCreate(
                ['game_id' => $round->game_id], // Condición para evitar duplicados
                [
                    'first_place' => $data['winner_id'],
                    'second_place' => $loserId,
                    'third_place' => $data['third_place'] ?? null,
                ]
            );
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
