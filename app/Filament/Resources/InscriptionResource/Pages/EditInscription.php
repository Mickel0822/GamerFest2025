<?php

namespace App\Filament\Resources\InscriptionResource\Pages;

use App\Filament\Resources\InscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInscription extends EditRecord
{
    protected static string $resource = InscriptionResource::class;

    protected array $members = [];

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Obtener los IDs de los miembros del equipo asociados a esta inscripción
        $data['members'] = $this->record->teamMembers()->pluck('user_id')->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Obtener los IDs de los miembros del equipo
        $members = $data['members'] ?? [];
        unset($data['members']); // Elimina 'members' para evitar conflictos

        // Eliminar los miembros actuales asociados a esta inscripción
        $this->record->teamMembers()->delete();

        // Crear los nuevos registros en team_members
        foreach ($members as $memberId) {
            \App\Models\TeamMember::create([
                'inscription_id' => $this->record->id, // ID de la inscripción actual
                'user_id' => $memberId,                // ID del miembro del equipo
            ]);
        }

        return $data;
    }


}
