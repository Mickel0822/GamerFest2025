<x-filament-panels::page.simple>
    <!-- Personaliza tu estilo aquí -->
    <!-- Carga el CDN de la fuente Adventure Request -->
    <link href="https://fonts.cdnfonts.com/css/adventure-request" rel="stylesheet">
    
    <!-- Carga el CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #dff2f9 !important; /* Fondo gris claro */
            background-image: url('/images/logoGamerFest1.png');
            background-repeat: repeat;
            background-size: 150px 150px; /* Cambia a un tamaño más pequeño */
            font-family: 'Adventure Request' !important; /* Usar la fuente Adventure Request */
        }

        h1 {
            color: rgb(0, 35, 82) !important; /* Cambia el color del título */
            text-align: center !important;
            margin-bottom: 20px !important;
        }

        /* Estilos para el formulario */
        #form {
            background-color:#dff2f9 !important;
            padding: 20px !important;
            border-radius: 8px !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
        }

        /* Estilos para los botones dentro del formulario */
        #form button {
            background-color: #66b3ff !important; /* Azul claro */
            color: white !important;
            padding: 10px !important;
            border-radius: 4px !important;
            border: none !important;
        }

        /* Hover sobre los botones */
        .form button:hover {
            background-color:rgb(6, 9, 13) !important; /* Azul más oscuro */
        }
    </style>

    @if (filament()->hasRegistration())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.actions.register.before') }}
            {{ $this->registerAction }}
        </x-slot>
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

    <x-filament-panels::form id="form" wire:submit="authenticate">
        {{ $this->form }}
        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}
</x-filament-panels::page.simple>
