<div>
    @foreach ($games as $game)
        <div class="box">
            <div class="game-card">
                <!-- Ajustamos el tamaño de la imagen en la tarjeta -->
                <img src="{{ $game->image_url }}" alt="{{ $game->name }}" class="w-48 h-48 object-cover rounded-lg">
                <h3>{{ $game->name }}</h3>
                <p>Precio: ${{ $game->price }}</p>
                <div class="game-buttons">
                    <a href="#">Inscribirse</a>
                    <a href="#">Reglas</a>
                    
                    <!-- Botón para mostrar los detalles -->
                    <button wire:click="toggleDetails({{ $game->id }})" class="btn btn-primary">
                        {{ $gameDetailsId === $game->id ? 'Ocultar Detalles' : 'Ver Detalles' }}
                    </button>
                </div>
            </div>

            <!-- Detalles del juego -->
            @if ($gameDetailsId === $game->id)
                <div class="bg-black text-white p-6 rounded-lg shadow mt-4">
                    <h1 class="text-3xl font-bold mb-4">{{ $game->name }}</h1>
                    <!-- Ajustamos el tamaño de la imagen en los detalles -->
                    <img src="{{ $game->image_url }}" alt="{{ $game->name }}" class="w-96 h-96 rounded-lg object-cover mb-4">
                    <p class="mt-4 text-lg">{{ $game->description ?? 'No hay descripción disponible para este juego.' }}</p>
                </div>
            @endif
        </div>
    @endforeach
</div>




