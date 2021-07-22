<div {{ $attributes->merge(['class' => "input-group col-12 col-xl mb-2"]) }} >

    <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="fas fa-search"></i>
        </span>
    </div>

    <input 
        id="{{ $attrId }}"
        type="{{ $type }}" 
        class="form-control" 
        placeholder="{{ $placeholder }}" 
        aria-label="{{ $placeholder }}." 
        aria-describedby="basic-addon2"
        value="{{ $value }}"
        name="{{ $name }}"
    >

</div>