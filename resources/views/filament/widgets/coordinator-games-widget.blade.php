<x-filament::widget>
    <x-filament::card class="bg-gray-50 dark:bg-gray-900 shadow-lg p-6">
        @php
            // Obtener el usuario autenticado
            $user = \Illuminate\Support\Facades\Auth::user();
            $game = null;
            $message = null;

            if (!$user) {
                $message = 'No se pudo identificar al usuario logueado.';
            } else {
                // Consultar el único juego asignado al coordinador
                $game = \App\Models\Game::where('coordinator_id', $user->id)
                    ->with('inscriptions.user')
                    ->first();

                if (!$game) {
                    $message = 'No se te ha asignado ningún juego.';
                }
            }
        @endphp

        {{-- Título del widget --}}
        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100 mb-6 text-center">
            Juego Asignado
        </h2>

        {{-- Mostrar mensaje si no hay juego asignado --}}
        @if ($message)
            <p class="text-center text-gray-600 dark:text-gray-400">{{ $message }}</p>
        @else
            {{-- Mostrar información del juego asignado --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                {{-- Imagen del juego o mensaje alternativo --}}
                <div class="text-center mb-6">
                    @if ($game->image_url)
                        <img src="{{ $game->image_url }}" alt="{{ $game->name }}"
                             class="w-48 h-48 object-cover rounded-lg shadow-lg mx-auto">
                    @else
                        <div class="w-48 h-48 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg shadow-md">
                            <p class="text-gray-500 dark:text-gray-400">Sin Imagen</p>
                        </div>
                    @endif
                </div>

                {{-- Información del juego --}}
                <h3 class="text-xl font-bold text-gray-900 dark:text-white text-center mb-4">{{ $game->name }}</h3>

                <div class="text-left space-y-4">
                    <p class="text-gray-800 dark:text-gray-300">
                        <strong class="font-semibold text-gray-900 dark:text-white">Lugar:</strong>
                        {{ $game->location ?? 'No especificado' }}
                    </p>
                    <p class="text-gray-800 dark:text-gray-300">
                        <strong class="font-semibold text-gray-900 dark:text-white">Reglas:</strong>
                        {{ $game->rules ?? 'No especificadas' }}
                    </p>
                    <p class="text-gray-800 dark:text-gray-300">
                        <strong class="font-semibold text-gray-900 dark:text-white">Fecha de Inicio:</strong>
                        {{ $game->start_time ? \Carbon\Carbon::parse($game->start_time)->format('d/m/Y') : 'No especificada' }}
                    </p>
                    <p class="text-gray-800 dark:text-gray-300">
                        <strong class="font-semibold text-gray-900 dark:text-white">Fecha de Fin:</strong>
                        {{ $game->end_time ? \Carbon\Carbon::parse($game->end_time)->format('d/m/Y') : 'No especificada' }}
                    </p>


                </div>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>
