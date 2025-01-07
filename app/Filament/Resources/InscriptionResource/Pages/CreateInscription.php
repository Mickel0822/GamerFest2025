<?php

namespace App\Filament\Resources\InscriptionResource\Pages;

use App\Filament\Resources\InscriptionResource;
use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Model; // Importa Model
use Filament\Resources\Pages\CreateRecord;


class CreateInscription extends CreateRecord
{
    protected static string $resource = InscriptionResource::class;
    protected array $members = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
     // Asignar el usuario actual
    // Extraer los miembros seleccionados
    $this->members = $data['members'] ?? [];
    unset($data['members']); // Remueve 'members' del array para evitar conflictos
    $data['user_id'] = auth()->id();
    $data['payment_method'] = 'comprobante';
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
