<x-filament-widgets::widget>
    <x-filament::section>
        <div class="space-y-6">
            <!-- Título principal -->
            <h1 class="text-2xl font-bold text-gray-100">Estado de Mis Inscripciones</h1>

            <!-- Sección: Juegos Pendientes -->
            <div>
                <h2 class="text-lg font-semibold text-gray-200">Juegos Pendientes</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse ($pending as $inscription)
                        <div class="bg-black shadow rounded-lg p-12 flex flex-col items-center" wire:key="pending-{{ $inscription->id }}">
                            <!-- Imagen del Juego -->
                            <img src="{{ $inscription->game->image_url }}" 
                                alt="{{ $inscription->game->name }}" 
                                class="!w-96 !h-96 rounded-lg object-cover shadow-lg">
                            <!-- Nombre del Juego -->
                            <p class="font-medium text-gray-200 mt-4">{{ $inscription->game->name }}</p>
                            <!-- Botón para Ver Detalles -->
                            <button
                                class="text-sm text-blue-400 mt-2 hover:text-blue-300"
                                wire:click="showGameDetails({{ $inscription->game->id }})"
                            >
                                Ver Detalles
                            </button>

                            <!-- Detalles del Juego -->
                            @if ($selectedGameId === $inscription->game->id)
                                <div class="mt-4 bg-gray-800 p-4 rounded-lg w-full">
                                    <p class="text-gray-300"><strong>Tipo de Juego:</strong> {{ ucfirst($inscription->game->type) }}</p>
                                    <p class="text-gray-300"><strong>Coordinador:</strong> {{ $inscription->game->coordinator->name ?? 'No Asignado' }}</p>
                                    <p class="text-gray-300"><strong>Fecha de Inicio:</strong> {{ $inscription->game->start_time }}</p>
                                    <p class="text-gray-300"><strong>Fecha de Finalización:</strong> {{ $inscription->game->end_time }}</p>
                                    <p class="text-gray-300"><strong>Ubicación:</strong> {{ $inscription->game->location }}</p>
                                    <p class="text-gray-300"><strong>Reglas:</strong> {{ $inscription->game->rules ?? 'No especificadas' }}</p>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500">No hay inscripciones en esta categoría.</p>
                    @endforelse
                </div>
            </div>

            <!-- Sección: Juegos Verificados -->
            <div>
                <h2 class="text-lg font-semibold text-gray-200">Juegos Verificados</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse ($verified as $inscription)
                        <div class="bg-black shadow rounded-lg p-32 flex flex-col items-center" wire:key="verified-{{ $inscription->id }}">
                            <!-- Imagen del Juego -->
                            <img src="{{ $inscription->game->image_url }}" 
                                alt="{{ $inscription->game->name }}" 
                                class="!w-64 !h-64 rounded-lg object-cover shadow-lg">
                            <!-- Nombre del Juego -->
                            <p class="font-medium text-gray-200 mt-4">{{ $inscription->game->name }}</p>
                            <!-- Botón para Ver Detalles -->
                            <button
                                class="text-sm text-blue-400 mt-2 hover:text-blue-300"
                                wire:click="showGameDetails({{ $inscription->game->id }})"
                            >
                                Ver Detalles
                            </button>

                            <!-- Detalles del Juego -->
                            @if ($selectedGameId === $inscription->game->id)
                                <div class="mt-4 bg-gray-800 p-4 rounded-lg w-full">
                                    <p class="text-gray-300"><strong>Tipo de Juego:</strong> {{ ucfirst($inscription->game->type) }}</p>
                                    <p class="text-gray-300"><strong>Coordinador:</strong> {{ $inscription->game->coordinator->name ?? 'No Asignado' }}</p>
                                    <p class="text-gray-300"><strong>Fecha de Inicio:</strong> {{ $inscription->game->start_time }}</p>
                                    <p class="text-gray-300"><strong>Fecha de Finalización:</strong> {{ $inscription->game->end_time }}</p>
                                    <p class="text-gray-300"><strong>Ubicación:</strong> {{ $inscription->game->location }}</p>
                                    <p class="text-gray-300"><strong>Reglas:</strong> {{ $inscription->game->rules ?? 'No especificadas' }}</p>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500">No hay inscripciones en esta categoría.</p>
                    @endforelse
                </div>
            </div>

            <!-- Sección: Juegos Rechazados -->
            <div>
                <h2 class="text-lg font-semibold text-gray-200">Juegos Rechazados</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse ($rejected as $inscription)
                        <div class="bg-black shadow rounded-lg p-32 flex flex-col items-center" wire:key="rejected-{{ $inscription->id }}">
                            <!-- Imagen del Juego -->
                            <img src="{{ $inscription->game->image_url }}" 
                                alt="{{ $inscription->game->name }}" 
                                class="!w-64 !h-64 rounded-lg object-cover shadow-lg">
                            <!-- Nombre del Juego -->
                            <p class="font-medium text-gray-200 mt-4">{{ $inscription->game->name }}</p>
                            <!-- Botón para Ver Detalles -->
                            <button
                                class="text-sm text-blue-400 mt-2 hover:text-blue-300"
                                wire:click="showGameDetails({{ $inscription->game->id }})"
                            >
                                Ver Detalles
                            </button>

                            <!-- Detalles del Juego -->
                            @if ($selectedGameId === $inscription->game->id)
                                <div class="mt-4 bg-gray-800 p-4 rounded-lg w-full">
                                    <p class="text-gray-300"><strong>Tipo de Juego:</strong> {{ ucfirst($inscription->game->type) }}</p>
                                    <p class="text-gray-300"><strong>Coordinador:</strong> {{ $inscription->game->coordinator->name ?? 'No Asignado' }}</p>
                                    <p class="text-gray-300"><strong>Fecha de Inicio:</strong> {{ $inscription->game->start_time }}</p>
                                    <p class="text-gray-300"><strong>Fecha de Finalización:</strong> {{ $inscription->game->end_time }}</p>
                                    <p class="text-gray-300"><strong>Ubicación:</strong> {{ $inscription->game->location }}</p>
                                    <p class="text-gray-300"><strong>Reglas:</strong> {{ $inscription->game->rules ?? 'No especificadas' }}</p>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500">No hay inscripciones en esta categoría.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
