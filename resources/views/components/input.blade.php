<div class="form-group">

    <label for="{{ $name }}">{!! $label !!}</label>

    @error($name) 
    @php $errorClass = 'is-invalid'; @endphp 
    @enderror

    <input  
        {{ $attributes->merge(['class' => "form-control ".($errorClass ?? '')]) }}
        type="{{ $type }}" 
        id="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        name="{{ $name }}" 
        value="{{ $value }}" >

    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    
</div>