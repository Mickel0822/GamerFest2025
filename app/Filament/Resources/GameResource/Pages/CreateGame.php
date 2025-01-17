<?php

namespace App\Filament\Resources\GameResource\Pages;

use App\Filament\Resources\GameResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGame extends CreateRecord
{
    protected function afterCreate(): void
    {
        $game = $this->record;

        // Cambiar el rol del coordinador
        if ($game->coordinator_id) {
            $coordinator = User::find($game->coordinator_id);
            if ($coordinator && $coordinator->role !== 'coordinator') {
                $coordinator->update(['role' => 'coordinator']);
            }
        }
    }

    protected static string $resource = GameResource::class;
}
