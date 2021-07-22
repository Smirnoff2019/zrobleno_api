<div class="form-group">
    
    @error($name) 
    @php $errorClass = 'is-invalid'; @endphp 
    @enderror

    <label 
        for="{{ $name }}" 
        class=""
    >{{ $label }}</label>
    
    <textarea 
        {{ $attributes->merge(['class' => "form-control ".($errorClass ?? '')]) }}
        id="{{ $name }}" 
        rows="{{ $rows }}" 
        name="{{ $name }}" 
        placeholder="{{ $placeholder }}"
    >{{ $slot }}{{ $value }}</textarea>

    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>