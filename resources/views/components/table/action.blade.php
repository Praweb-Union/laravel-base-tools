@props(['text'])
<div {{ $attributes->merge(['class' => 'mt-0 ml-4']) }}>
    <button wire:click="openModal()"
            type="button"
            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
        {{ $text }}
    </button>
</div>
