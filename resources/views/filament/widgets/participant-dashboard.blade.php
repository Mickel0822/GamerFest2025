<x-filament::widget>
    <x-filament::card>
        @php
            // Obtener el usuario autenticado
            $user = \Illuminate\Support\Facades\Auth::user();
            $categories = [
                'Juegos Pendientes' => $pending,
                'Juegos Verificados' => $verified,
                'Juegos Rechazados' => $rejected,
            ];
        @endphp

        {{-- Título del widget --}}
        <h2 class="text-xl font-extrabold text-gray-800 dark:text-gray-100 mb-6 text-center">
            Estado de Mis Inscripciones
        </h2>

        @foreach ($categories as $category => $inscriptions)
            {{-- Título de la categoría --}}
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-200 mb-4">{{ $category }}</h3>

            @if ($inscriptions->isEmpty())
                <p class="text-center text-gray-500 dark:text-gray-400 mb-6">No tienes inscripciones en esta categoría.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($inscriptions as $inscription)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 transition hover:shadow-lg">
                            {{-- Imagen del juego --}}
                            <div class="text-center">
                                @if ($inscription->game->image_url)
                                    <img src="{{ $inscription->game->image_url }}"
                                        alt="{{ $inscription->game->name }}"
                                        class="w-full h-40 object-cover rounded-t-lg">
                                @else
                                    <div class="w-full h-40 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-t-lg">
                                        <p class="text-gray-500 dark:text-gray-400">Sin Imagen</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Detalles del juego --}}
                            <div class="mt-4">
                                <h4 class="text-lg font-bold text-gray-800 dark:text-gray-100">{{ $inscription->game->name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Lugar:</strong> {{ $inscription->game->location ?? 'No especificado' }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($inscription->game->start_time)->format('d/m/Y') }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Fecha de Fin:</strong> {{ \Carbon\Carbon::parse($inscription->game->end_time)->format('d/m/Y') }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Reglas:</strong> {{ $inscription->game->rules ?? 'No especificadas' }}</p>

                                {{-- Botón de ver detalles --}}
                                <button
                                    class="mt-4 py-2 px-4 text-sm font-medium text-white rounded-lg bg-blue-600 dark:bg-blue-500 hover:opacity-90"
                                    wire:click="showGameDetails({{ $inscription->game->id }})"
                                >
                                    {{ $selectedGameId === $inscription->game->id ? 'Ocultar Detalles' : 'Ver Detalles' }}
                                </button>

                                {{-- Detalles adicionales --}}
                                @if ($selectedGameId === $inscription->game->id)
                                    <div class="mt-4 bg-gray-200 dark:bg-gray-900 p-4 rounded-lg space-y-2">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            <strong>Coordinador:</strong> {{ $inscription->game->coordinator->name ?? 'No asignado' }}
                                        </p>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            <strong>Ubicación:</strong> {{ $inscription->game->location ?? 'No especificado' }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </x-filament::card>
</x-filament::widget>
