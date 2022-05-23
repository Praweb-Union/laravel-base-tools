<button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4" {{ $attributes->whereStartsWith('wire:') }}>
    {{ $slot }}
</button>
