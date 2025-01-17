<x-filament::widget>
    <x-filament::card>
        @php
        
            // Obtener el usuario autenticado
            $user = \Illuminate\Support\Facades\Auth::user();
            $games = null;
            $message = null;

            if (!$user) {
                $message = 'No se pudo identificar al usuario logueado.';
            } else {
                // Consultar los juegos asignados al coordinador
                $games = \App\Models\Game::where('coordinator_id', $user->id)
                    ->with('inscriptions.user')
                    ->get();

                if ($games->isEmpty()) {
                    $message = 'No se te han asignado juegos.';
                }
            }
        @endphp

        {{-- Verifica si hay un mensaje o los juegos están definidos --}}
        @if ($message)
            <p class="text-gray-500">{{ $message }}</p>
        @elseif ($games && $games->isNotEmpty())
            <h2 class="text-lg font-bold mb-4">Juego Asignado</h2>
            <div class="grid grid-cols-1 gap-6">
                @foreach ($games as $game)
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        {{-- Imagen del juego y nombre arriba --}}
                        <div class="text-center">
                            @if ($game->image_url)
                                <h3 class="text-lg font-bold mb-2">{{ $game->name }}</h3>
                                <img src="{{ $game->image_url }}" alt="{{ $game->name }}" class="w-32 h-32 object-cover rounded-lg shadow-md mx-auto mb-2">
                            @else
                                <h3 class="text-lg font-bold mb-2">{{ $game->name }}</h3>
                                <p class="text-gray-500">Sin imagen</p>
                            @endif

                            {{-- Detalles debajo de la imagen --}}
                            <div class="text-left mt-4">
                                <p><strong>Lugar:</strong> {{ $game->location ?? 'No especificado' }}</p>
                                <p><strong>Reglas:</strong> {{ $game->rules ?? 'No especificadas' }}</p>
                                <ul class="list-disc list-inside">
                                    @foreach ($game->inscriptions as $inscription)
                                        <li>{{ $inscription->team_name ?? ($inscription->user->name ?? 'Desconocido') }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No tienes ningun juego asignado.</p>
        @endif

        {{-- Mostrar información del usuario autenticado --}}
        @if ($user)
        @endif
    </x-filament::card>
</x-filament::widget>
