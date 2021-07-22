@props([
    'id'          => null,
    'title'       => '',
    'value'       => '',
    'name'        => null,
    'description' => null,
    'placeholder' => null,
    'rows'        => 4,
])

{{-- Name param field --}}
<x-meta.collapse-area.table-row>
    <x-slot name="label">
        <label for="{{ $id }}" class="mb-0"><strong>{{ $title }}</strong></label>
        @isset($description)
            <p class="fs-2 mb-0 font-weight-light">{!! $description !!}</p>
        @endisset
    </x-slot>

    <div class="form-group">
        <textarea 
            {{ $attributes->merge(['class' => "meta-field-param-field form-control text-black "]) }}
            id="{{ $id }}" 
            rows="{{ $rows }}" 
            name="{{ $name }}" 
            placeholder="{{ $placeholder ?? $title }}"
        >{{ $value }}</textarea>

        @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{ $slot }}
</x-meta.collapse-area.table-row>