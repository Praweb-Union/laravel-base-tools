@props(['label' => '', 'id' => \Praweb\BaseTools\Fields\Field::getRandomId()])
<label class="form-check-label inline-block text-gray-800" for="{{ $id }}">
    {{ $label }}
</label>
<br>
    <select id="{{ $id }}" class="
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
      "{{ $attributes }}>
        @foreach($options as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>

