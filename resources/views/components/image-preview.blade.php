@if (!empty($image_url))
    <div class="flex justify-center">
        <img
            src="{{ $image_url }}"
            alt="Comprobante de Pago"
            class="rounded-lg shadow-lg max-w-md cursor-pointer"
            onclick="window.open('{{ $image_url }}', '_blank')"
        />
    </div>
@else
    <p class="text-gray-500">No hay comprobante de pago disponible.</p>
@endif
