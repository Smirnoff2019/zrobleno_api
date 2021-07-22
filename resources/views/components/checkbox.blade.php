<div class="form-group mb-3">
    <div class="form-check form-custom-toggle-checkbox pl-0">
        <input type="checkbox" class="form-check-input" id="{{ $attrId }}" @if($isChecked()) checked="checked" @endif name="{{ $name }}" value="1">
        <label class="form-check-label" for="{{ $attrId }}">
            <span class="toggle mr-3">
                <span class="dot"></span>
                <span class="marker"></span>
            </span>
            {{ $label }}
        </label>
    </div>
</div>