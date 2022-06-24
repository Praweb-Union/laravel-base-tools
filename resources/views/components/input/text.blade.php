@props(['label' => '', 'id' => \Praweb\BaseTools\Fields\Field::getRandomId()])

<div class="mb-3 xl:w-96">
    <label for="{{ $id }}" class="form-check-label inline-block text-gray-800"
    >{{ $label }}</label>
    <input {{ $attributes }}
           class="
        form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
      "
           id="{{ $id }}"
    />
</div>

