<x-slot name="body">
    <x-praweb::table.row>
        <x-praweb::table.cell>
            <div class="max-w-full mx-auto">
                <button wire:click="openModal()"
                        type="button"
                        class="relative block w-full border-2 border-cyan-300 border-dashed rounded-lg p-12 text-center hover:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                        <span class="mt-2 block text-sm font-medium text-gray-900">
                                              {{ $text }}
                                        </span>
                </button>
            </div>
        </x-praweb::table.cell>
    </x-praweb::table.row>
</x-slot>
