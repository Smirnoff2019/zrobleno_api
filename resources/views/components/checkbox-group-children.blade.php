@props(['attrId' => null, 'value' => null, 'label' => null, 'children' => null, 'checked' => null, ])
@foreach($options as $checkbox)
    <li class="mb-1">
        <input 
            type="checkbox" 
            class="custom-control-input" 
            id="{{ $attrId = 'checkboxGroup-'.rand(10, time()) }}"  
            value="{{ $value = $getValue($checkbox) }}" 
            name="{{ $name = $attributes->get('name', 'checkboxGroup[]') }}"
            @if($checked = $isChecked($checkbox)) checked="checked" @endif 
        >
        <label 
            class="custom-control-label" 
            for="{{ $attrId }}" >
            {{ $label = $getLabel($checkbox) }}
        </label>

        @if(($children = $checkbox->{$childrenIn}) && !$children->isEmpty())
        <ul class="custom-control custom-checkbox my-2">
            <x-checkbox-group-children 
                :labelIn="$labelIn"
                :valueIn="$valueIn"
                :childrenIn="$childrenIn"
                :masterValue="$masterValue"
                :name="$name"
                :options="$children"
            />
        </ul>
        @endif
    </li>
@endforeach