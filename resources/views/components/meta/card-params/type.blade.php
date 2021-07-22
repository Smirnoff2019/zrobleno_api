@props([
    'title'       => 'Тип поля',
    'value'       => '',
    'description' => null,
    'name'        => null,
    'id'          => null
])

{{-- Type param field --}}
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
            class="meta-field-param-field meta-field-param-field--type form-control text-black" 
            value="{{ $value }}"
            name="{{ $name }}"
            {{ $attributes->whereStartsWith('data-') }}
            >   
            @include('includes.meta-fields-types', ['type' => $value])
        </select>
    </div>

    {{ $slot }}
</x-meta.collapse-area.table-row>