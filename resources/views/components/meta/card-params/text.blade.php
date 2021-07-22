@props([
    'id'          => null,
    'title'       => '',
    'value'       => '',
    'name'        => null,
    'description' => null,
    'placeholder' => null,
])

{{-- Name param field --}}
<x-meta.collapse-area.table-row>
    <x-slot name="label">
        <label for="{{ $id }}" class="mb-0"><strong>{{ $title }}</strong></label>
        @isset($description)
            <p class="fs-2 mb-0 font-weight-light">{{ $description }}</p>
        @endisset
    </x-slot>

    <div class="form-group">
        <input 
            id="{{ $id }}" 
            type="text" 
            {{ $attributes->merge(['class' => "meta-field-param-field form-control text-black"]) }}
            placeholder="{{ $placeholder ?? $title }}"
            value="{{ $value }}"
            name="{{ $name }}"
            {{ $attributes->whereStartsWith('data-') }}
        >
    </div>

    {{ $slot }}
</x-meta.collapse-area.table-row>