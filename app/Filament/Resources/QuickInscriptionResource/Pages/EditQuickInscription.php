<?php

namespace App\Filament\Resources\QuickInscriptionResource\Pages;

use App\Filament\Resources\QuickInscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuickInscription extends EditRecord
{
    protected static string $resource = QuickInscriptionResource::class;
    protected array $members = [];

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Extraer los miembros seleccionados
        $this->members = $data['members'] ?? [];
        unset($data['members']); // Remueve 'members' para evitar conflictos

        return $data; // Devuelve los datos restantes (sin duplicar la inscripción)
    }

    protected function afterSave(): void
    {
        // Elimina los miembros actuales asociados a esta inscripción
        $this->record->teamMembers()->delete();

        // Guarda los nuevos miembros en la tabla team_members
        foreach ($this->members as $memberId) {
            \App\Models\TeamMember::create([
                'inscription_id' => $this->record->id, // ID de la inscripción
                'user_id' => $memberId,                // ID del miembro del equipo
            ]);
        }
    }

}
