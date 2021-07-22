<div class="form-group">
    
    <label 
        for="{{ $name }}" 
        class=""
    >{{ $label }}</label>
    
    <textarea 
        class="form-control ckeditor" 
        id="{{ $name }}" 
        rows="{{ $rows }}" 
        name="{{ $name }}" 
        placeholder="{{ $placeholder }}"
    >{{ $slot }}</textarea>

    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <div class="d-none hide" hidden>
        <button 
            id="modal-gallery-ckeditor-handle-btn"
            type="button" 
            class="btn btn-primary btn-sm px-4 mx-2 my-1 mt-2"  
            data-toggle="modal" 
            data-type="image-gallery"
            data-target="#{{ $targetModalName = "modal-gallery-ckeditor" }}"
            data-mode="single"
        ></button>
    </div>

</div>

@push('modals')
    <x-modals.gallery 
        name="{{ $targetModalName }}"
    />  
@endpush