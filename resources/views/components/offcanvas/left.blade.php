@props(['id' => 'modal', 'title', 'isModalOpened' => false])
<div class="offcanvas offcanvas-start fixed bottom-0 flex flex-col max-w-full bg-white  bg-clip-padding shadow-sm outline-none transition duration-300 ease-in-out text-gray-700 top-0 left-0 border-none w-96 @if($isModalOpened) show @endif" id="{{ $id }}">
    <div class="offcanvas-header flex items-center justify-between p-4">
        <h5 class="offcanvas-title mb-0 leading-normal font-semibold">{{ $title }}</h5>
        <button type="button" class="btn-close box-content w-4 h-4 p-2 -my-5 -mr-2 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" wire:click="closeAllModals()"></button>
    </div>
    <div class="offcanvas-body flex-grow p-4 overflow-y-auto">
        {{ $slot }}
    </div>
</div>
@if($isModalOpened)
    <div class="offcanvas-backdrop fade show" wire:click="closeAllModals()"></div>
@endif
