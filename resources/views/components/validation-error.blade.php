@props(['for'])

@error($for)
<p style="font-size: 11px;" {{ $attributes->merge(['class' => 'font-semibold pt-1.5 text-red']) }}>{{ $message }}</p>
@enderror
