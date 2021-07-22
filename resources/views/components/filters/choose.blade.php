<div {{ $attributes->merge(['class' => "input-group col-12 col-lg mb-2"])->except('select:class') }} >

    <div class="input-group-prepend">
        <label class="input-group-text" for="{{ $attrId }}">{{ $label }}</label>
    </div>
    
    <select 
        class="custom-select {{ $attributes->whereStartsWith('select:class')->first() }}"
        id="{{ $attrId }}"
        value="{{ $value }}"
        name="{{ $name }}"
    >
        <option {{ $isSelectedDefault() ? 'selected' : ''}} value="">{{ $default }}</option>

        {{ $slot }}

        @isset($options)
            @foreach($options as $key => $value)
            
                @if(is_array($value))

                    <optgroup label="{{ $key }}">
                    @foreach($value as $optionValue => $optionName)
                        <option 
                            value="{{ $optionValue }}" 
                            {{ $isSelected($optionValue) ? 'selected' : ''}} 
                        >{{ $optionName }}</option>
                    @endforeach

                @else

                <option 
                    value="{{ $key }}" 
                    {{ $isSelected($key) ? 'selected' : ''}} 
                >{{ $value }}</option>

                @endif

            @endforeach
        @endisset
    </select>

</div>
