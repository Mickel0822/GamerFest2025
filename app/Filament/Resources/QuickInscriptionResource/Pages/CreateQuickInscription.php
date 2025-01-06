<?php

namespace App\Filament\Resources\QuickInscriptionResource\Pages;

use App\Filament\Resources\QuickInscriptionResource;
use App\Models\TeamMember;
use Filament\Resources\Pages\CreateRecord;

class CreateQuickInscription extends CreateRecord
{
    protected static string $resource = QuickInscriptionResource::class;
    protected array $members = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'verificado'; // Aseguramos que el estado sea "verificado".
        $this->members = $data['members'] ?? [];
        unset($data['members']); // Remueve 'members' del array para evitar conflictos

        return $data; // Devuelve los datos restantes (sin duplicar la inscripción)
    }

    protected function afterCreate(): void
    {
        // Guarda los miembros seleccionados en la tabla team_members
        foreach ($this->members as $memberId) {
            \App\Models\TeamMember::create([
                'inscription_id' => $this->record->id, // ID de la inscripción recién creada
                'user_id' => $memberId,                // ID del miembro del equipo
            ]);
        }
    }
}
