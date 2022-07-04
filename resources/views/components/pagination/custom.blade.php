<nav class="relative z-0 inline-flex rounded-md space-x-1" aria-label="Pagination">
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)


        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="relative inline-flex items-center px-2 py-2 rounded-3xl text-sm font-medium text-gray/[0.5] hover:text-blue transition-all duration-200"
                aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <button type="button"
                    dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                    class="relative inline-flex items-center px-2 py-2 rounded-3xl text-sm font-medium text-gray/[0.5] hover:text-blue transition-all duration-200"
                    wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                    rel="prev" aria-label="@lang('pagination.previous')">
                <span class="sr-only">Previous</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span
                    class="relative inline-flex items-center px-4 py-2 rounded-3xl text-sm font-medium text-gray/[0.3]"> ... </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"
                            wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"
                            aria-current="page"><span
                                class="z-10 bg-blue border-blue text-white rounded-3xl relative inline-flex items-center px-4 py-2 border text-sm font-medium transition-all duration-200">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item"
                            wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}">
                            <button type="button"
                                    class="bg-white border-gray-border text-gray hover:text-blue rounded-3xl hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium transition-all duration-200"
                                    wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <button type="button"
                        dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                        class="relative inline-flex items-center px-2 py-2 rounded-3xl text-sm font-medium text-gray/[0.5] hover:text-blue transition-all duration-200"
                        wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                        rel="next" aria-label="@lang('pagination.next')"><span class="sr-only">Next</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </li>
        @else
            <li class="relative inline-flex items-center px-2 py-2 rounded-3xl text-sm font-medium text-gray/[0.5] hover:text-blue transition-all duration-200"
                aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    @endif
</nav>
