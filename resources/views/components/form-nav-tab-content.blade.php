@props(['name', 'label', 'state'])
<div
    class="{{ ($state == true) ? 'show active' : '' }} {{ $attributes->merge(['class' => 'tab-pane fade'])->get('class') }}"
    id="{{ $name }}" 
    role="tabpanel" 
    aria-labelledby="{{ $name }}-tab"
>
{{ $slot }}
</div>