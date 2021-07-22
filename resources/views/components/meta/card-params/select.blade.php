@props([
    'id'          => null,
    'title'       => '',
    'value'       => '',
    'name'        => null,
    'description' => null,
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
        <select 
            id="{{ $id }}"
            {{ $attributes->merge(['class' => "meta-field-param-field form-control text-black"]) }}
            value="{{ $value }}"
            name="{{ $name }}"
            {{ $attributes->whereStartsWith('data-') }}
            >   
            {{ $slot }}
        </select>
    </div>
</x-meta.collapse-area.table-row>