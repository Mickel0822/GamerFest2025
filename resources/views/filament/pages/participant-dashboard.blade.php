<x-filament::page>
<div class="space-y-6">
    <h1 class="text-2xl font-bold">Estado de Mis Inscripciones</h1>

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
