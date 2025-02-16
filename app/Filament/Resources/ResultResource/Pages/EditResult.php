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

        // Obtener los nombres correspondientes según el tipo de enfrentamiento
        $winnerName = $result->match_type === 'group'
            ? Inscription::find($data['winner_id'])?->team_name
            : Inscription::find($data['winner_id'])?->user?->name;

        $loserName = $result->match_type === 'group'
            ? Inscription::find($loserId)?->team_name
            : Inscription::find($loserId)?->user?->name;

        $thirdPlaceName = $result->match_type === 'group'
            ? Inscription::find($data['third_place'])?->team_name
            : Inscription::find($data['third_place'])?->user?->name;

        // Si es la final, guardar los nombres en `game_winners`
        if ($round->type === 'final') {
            GameWinner::updateOrCreate(
                ['game_id' => $round->game_id], // Para evitar duplicados
                [
                    'first_place' => $winnerName,
                    'second_place' => $loserName,
                    'third_place' => $thirdPlaceName,
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
