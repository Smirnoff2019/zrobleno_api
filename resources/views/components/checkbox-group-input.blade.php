@props([
    'attrId'  => 'checkboxGroup-'.rand(10, time()),
    'value' => null,
    'label' => 'Not found',
    'checked' => false,
])

<li class="mb-1">
    <input 
        type="checkbox" 
        class="custom-control-input" 
        id="{{ $attrId }}"  
        value="{{ $value }}" 
        name="{{ $attributes->get('name', 'checkboxGroup[]') }}"
        @if($checked) checked="checked" @endif 
    >
    <label 
        class="custom-control-label" 
        for="{{ $attrId }}" >
        {{ $label }}
    </label>
    
    @if(!$slot->isEmpty())
    <ul class="custom-control custom-checkbox my-2">
        {{ $slot }}
    </ul>
    @endif
</li>