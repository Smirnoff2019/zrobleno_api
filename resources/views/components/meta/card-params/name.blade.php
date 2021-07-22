@props([
    'title'       => 'Назва',
    'value'       => '',
    'description' => 'Ця назва відображується на сторінці редагування',
    'metaId'      => null,
    'name'        => null,
    'id'          => null
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
            class="meta-field-param-field meta-field-param-field--name form-control text-black" 
            placeholder="Назва поля..."
            value="{{ $value }}"
            name="{{ $name }}"
            {{ $attributes->whereStartsWith('data-') }}
            >
    </div>

    {{ $slot }}
</x-meta.collapse-area.table-row>