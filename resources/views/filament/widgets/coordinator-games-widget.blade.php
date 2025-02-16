<x-filament::widget>
    <x-filament::card class="bg-gray-50 dark:bg-gray-900 shadow-lg p-6">
        @php
            $user = \Illuminate\Support\Facades\Auth::user();
            $game = null;
            $results = collect(); // Colección vacía para evitar errores
            $message = null;

            if (!$user) {
                $message = 'No se pudo identificar al usuario logueado.';
            } else {
                $game = \App\Models\Game::where('coordinator_id', $user->id)
                    ->with('inscriptions.user')
                    ->first();

                if (!$game) {
                    $message = 'No se te ha asignado ningún juego.';
                } else {
                    $results = \App\Models\Result::where('game_id', $game->id)
                    ->with('winner.user:id,name,last_name') // Asegurar que carga ambos campos
                    ->get();
                }
            }

            $startTime = $game && $game->start_time ? \Carbon\Carbon::parse($game->start_time) : null;
        @endphp

        @if ($message)
            <p class="text-center text-gray-600 dark:text-gray-400">{{ $message }}</p>
        @endif

        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100 mb-6 text-center">
            Juego Asignado
        </h2>

        @if ($message)
            <p class="text-center text-gray-600 dark:text-gray-400">{{ $message }}</p>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
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
            </div>
        @endif

        @if ($game)
            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6 col-span-full">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
                        <span class="text-sm font-medium text-black-700 dark:text-black-300 block mb-2">Número de juego</span>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $game->id }}</p>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
                        <span class="text-sm font-medium text-black-700 dark:text-black-300 block mb-2">Número de participantes</span>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $game->inscriptions->count() }}</p>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
                        <span class="text-sm font-medium text-black-700 dark:text-black-300 block mb-2">Fecha</span>
                        <p class="text-2xl font-bold text-red-500 dark:text-red-400">
                            {{ $startTime ? $startTime->format('d/m/Y') : 'No definida' }}
                        </p>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
                        <span class="text-sm font-medium text-black-700 dark:text-black-300 block mb-2">Hora</span>
                        <p class="text-2xl font-bold text-green-500 dark:text-green-400">
                            {{ $startTime ? $startTime->format('H:i') : 'No definida' }}
                        </p>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
                        <span class="text-sm font-medium text-black-700 dark:text-black-300 block mb-2">Lugar</span>
                        <p class="text-2xl font-bold text-blue-500 dark:text-blue-400">{{ $game->location ?? 'No especificado' }}</p>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
                        <span class="text-sm font-medium text-black-700 dark:text-black-300 block mb-2">Estado del juego</span>
                        <p class="text-2xl font-bold text-blue-500 dark:text-blue-400">{{ ucfirst($game->status) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6 col-span-full">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

                    <div class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6 col-span-full">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md text-center col-span-2">
                                <span class="text-sm font-medium text-black-700 dark:text-black-300 block mb-2">
                                    Estado de participantes
                                </span>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-lg font-semibold text-blue-500 dark:text-blue-400">
                                    @if ($results->isNotEmpty())
                                    @foreach ($results as $result)
                                        <div class="flex justify-center">
                                        {{ optional($result->winner->user)->last_name }} {{ optional($result->winner->user)->name }}
                                        </div>
                                    @endforeach
                                    @else
                                        <p class="text-center text-red-500">No hay resultados disponibles.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </x-filament::card>
</x-filament::widget>