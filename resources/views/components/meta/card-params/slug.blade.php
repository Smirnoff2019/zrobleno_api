@props([
    'title'       => 'Ярлик',
    'value'       => '',
    'description' => 'Одне слово, без пробілів. Можете використовувати нижнє підкреслення.',
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
            class="meta-field-param-field meta-field-param-field--slug form-control text-black" 
            placeholder=""
            value="{{ $value }}"
            name="{{ $name }}"
            {{ $attributes->whereStartsWith('data-') }}
            >
    </div>

    {{ $slot }}
</x-meta.collapse-area.table-row>