<div class="form-group">

    <label for="{{ $name }}">{{ $label }}</label>
    
    <select 
        class="@error($name) is-invalid @enderror {{ $attributes->merge(['class' => 'form-control '])->first() }}"
        id="{{ $name }}" 
        name="{{ $name }}"
        value="{{ $value }}"
    >
        
        @foreach($options ?? [] as $key => $option)
            <x-select-option 
                :label="$option['label']"
                :value="$option['value']"
                :selected="$isSelected($option['value'])"
            />
        @endforeach

        {{ $slot }}

    </select>

    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>