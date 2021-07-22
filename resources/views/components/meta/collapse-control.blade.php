@props([
    'target',
    'expanded' => "false",
    'name'     => "meta_field_".rand(10, 99999),
    'checked'  => false
])

{{-- meta-field-card-collapse--control --}}
<div class="btn-group-toggle mx-1" data-toggle="buttons">
    <label 
        {{ $attributes->merge([
            'class' => ($checked ? 'text-primary bg-white shadow-sm' : '') . "
                meta-field-card-collapse--control 
                fs-2 mb-0 py-2
                collapsed 
                d-flex align-items-center justify-content-center 
                btn btn-sm btn-square btn-light 
                border ",
        ]) }}
        data-toggle="collapse" 
        data-target="#{{ $target }}" 
        aria-expanded="{{ $checked ? "true" : "false" }}" 
        aria-controls="{{ $target }}"
    >
        <input 
            type="checkbox" 
            hidden 
            autocomplete="off"
            {{-- name="{{ $name }}" --}}
            @checked($checked)
        >
        {{ $slot }}
    </label>
</div>