<x-filament::page>

    <!-- Agregar el archivo de CSS -->
    @push('styles')
        <link href="{{ asset('css/stylesDash.css') }}" rel="stylesheet">
    @endpush


    <!-- Encabezado con el nombre del usuario y su foto -->
    <div class="bg-gray-800 text-white p-2 rounded-lg shadow flex flex-col items-start">
        <div class="flex flex-col items-center">
            <h1 class="text-6xl font-extrabold text-center mb-4">
                ¡Hola, {{ Auth::user()->name }}!
            </h1>
            <img src="{{ Auth::user()->profile_photo }}" 
                 alt="Foto de Perfil" 
                 class="w-32 h-32 rounded-full border-4 border-gray-400">
        </div>
    </div>

    <!-- Sección de Estadísticas del Jugador -->
    <div class="w-full">
        <div class="bg-gray-900 text-white p-4 rounded-lg shadow w-full md:w-1/2 ml-4">
            <h2 class="text-2xl font-bold mb-4">Estadísticas del Jugador</h2>
            <ul class="space-y-2">
                <li class="flex justify-between">
                    <span>Juegos Jugados:</span>
                    <span>{{ $playerStats['games_played'] ?? 0 }}</span>
                </li>
                <li class="flex justify-between">
                    <span>Victorias/Derrotas:</span>
                    <span>{{ $playerStats['wins'] ?? 0 }} / {{ $playerStats['losses'] ?? 0 }}</span>
                </li>
                <li class="flex justify-between">
                    <span>Puntuación Total:</span>
                    <span>{{ $playerStats['total_score'] ?? 0 }}</span>
                </li>
                <li class="flex justify-between">
                    <span>Porcentaje de Asistencia:</span>
                    <span>{{ $playerStats['attendance_percentage'] ?? 0 }}%</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Sección de Próximos Juegos y Calendario -->
    <div class="flex flex-col lg:flex-row mt-10 w-full gap-8">
        <!-- Lista de Próximos Juegos -->
        <div class="bg-gray-800 text-white p-4 rounded-lg shadow w-full lg:w-1/3">
            <h2 class="text-2xl font-bold mb-4">Próximos Juegos</h2>
            <div class="bg-gray-900 p-4 rounded-lg shadow w-full">
                <h3 class="text-lg font-semibold mb-2">Lista de Juegos</h3>
                <ul class="space-y-2">
                    @foreach ($games ?? [] as $game)
                        <li class="flex items-center justify-between text-sm">
                            <span>{{ $game['date'] }}</span>
                            <span class="font-semibold">{{ $game['name'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <a href="/admin/inscriptions" class="bg-cyan-500 text-white px-4 py-2 rounded-lg mt-6 block text-center">
                Inscribirse en un Nuevo Juego
            </a>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach (['pending' => 'Juegos Pendientes', 'verified' => 'Juegos Verificados', 'rejected' => 'Juegos Rechazados'] as $key => $title)
            <div class="bg-white shadow rounded-lg p-4">
                <h2 class="text-lg font-semibold">{{ $title }}</h2>
                <div class="mt-4 space-y-4">
                    @forelse ($$key as $inscription)
                        <div class="flex items-center space-x-4 p-12">
                            <!-- Aumentamos el tamaño de las imágenes -->
                            <img src="{{ $inscription->game->image_url }}" alt="Juego" class="w-96 h-96 rounded">
                            <div>
                                <p class="font-medium">{{ $inscription->game->name }}</p>
                                <a href="{{ route('game.details', $inscription->game->id) }}" class="text-sm text-blue-500">Ver Detalles</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No hay inscripciones en esta categoría.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>
</x-filament::page>
