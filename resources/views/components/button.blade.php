<button {{ $attributes }} type="button" class="inline-block px-6 py-2.5 bg-{{ $color }}-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-{{ $color }}-600 hover:shadow-lg focus:bg-{{ $color }}-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-{{ $color }}-700 active:shadow-lg transition duration-150 ease-in-out">
    {{ $slot }}
</button>
