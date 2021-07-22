@props(['name', 'label'])
<a  class="{{ ($state == true) ? 'active' : '' }} {{ $attributes->merge(['class' => 'nav-item nav-link'])->get('class') }}" 
    id="{{ $name }}-tab" 
    data-toggle="tab" 
    href="#{{ $name }}" 
    role="tab" 
    aria-controls="{{ $name }}" 
    aria-selected="{{ ($state == true) ? 'true' : 'false' }}"
>{{ $label }}</a>