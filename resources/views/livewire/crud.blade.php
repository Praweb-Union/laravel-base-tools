<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-offcanvas.right :is-modal-opened="$isModalOpened" title="Форма создания категории">
                <form wire:submit.prevent="create" enctype="multipart/form-data">
                    @foreach($fields as $field)
                        <div class="mb-2">й
                            {!! $field->render() !!}
                            <x-validation-error for="{{ $field->getField() }}"/>
                        </div>
                    @endforeach
                    <x-button.green type="submit">Сохранить</x-button.green>
                </form>
            </x-offcanvas.right>

            <div class="py-12">
                <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white sm:rounded-lg">
                        <x-table.table>
                            <x-slot name="header">
                                <x-table.search/>
                                <x-table.action text="Создать категорию"/>
                            </x-slot>
                            @if (!count($objects))
                                <x-slot name="head">
                                    <x-table.heading sortable>Результатов не найдено</x-table.heading>
                                </x-slot>
                                <x-table.no-objects-create-button text="Создать категорию"/>
                            @else
                                <x-slot name="head">

                                    @foreach($fields as $field)
                                        @if($field->getShowInTableClassName() !== \Praweb\BaseTools\ShowInTables\EmptyCell::class)
                                            <x-table.heading
                                                direction="{{ \Praweb\BaseTools\BaseComponent::sortDirection($sort, $field->getField()) }}"
                                                wire:click="updateSort('{{ $field->getField() }}')" sortable>
                                                {{ $field->getColumnName() }}
                                            </x-table.heading>
                                        @endif
                                    @endforeach
                                </x-slot>
                                <x-slot name="body">
                                    @foreach ($objects as $object)
                                        <x-table.row>
                                            @foreach($fields as $field)
                                                <x-table.cell>
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {!! $field->getShowInTableClassName()::render(($object->{str_replace('object.', '', $field->getField())})) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </x-table.cell>
                                            @endforeach

                                            <x-table.cell class="flex justify-end">
                                                <x-jet-dropdown align="right" width="48">
                                                    <x-slot name="trigger">
                                                        <div class="">
                                                            <button type="button"
                                                                    class="flex max-w-xs bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 lg:p-2 lg:rounded-md lg:hover:bg-gray-50"
                                                                    id="dropdown-{{ $object->id }}"
                                                                    aria-expanded="false"
                                                                    aria-haspopup="true">
                                                                <svg class="h-5 w-5 text-cyan-600"
                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 20 20"
                                                                     fill="currentColor" aria-hidden="true">
                                                                    <path
                                                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </x-slot>

                                                    <x-slot name="content">
                                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                                            Управление
                                                        </div>
                                                        <a href="#"
                                                           type="button"
                                                           class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"
                                                           wire:click="openModal({{ $object->id }})">
                                                            Редактировать
                                                        </a>
                                                        <a href="#"
                                                           type="button"
                                                           class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"
                                                           wire:click="delete({{ $object->id }})">
                                                            Удалить
                                                        </a>
                                                    </x-slot>
                                                </x-jet-dropdown>
                                            </x-table.cell>
                                        </x-table.row>
                                    @endforeach
                                </x-slot>
                            @endif
                            @if($withPaginate)
                                <x-slot name="footer">
                                    <x-table.footer>
                                        {{ $objects->links('components.pagination.tailwind') }}
                                    </x-table.footer>
                                </x-slot>
                            @endif
                        </x-table.table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



