<div {{ $attributes->merge(['class' => 'form-group' ]) }}>
    @isset($label)
        <label for="">{{ $label }}</label>
    @endisset

    <div class="p-2 border bg-light">
        
        <input 
            type="hidden" 
            id="{{ $inputId }}" 
            value="{{ $value }}" 
            name="{{ $name }}">
        
        <label class="preview-images mb-2" for="{{ $inputId }}">
            <img src="{{ $url }}" alt="" class="img-thumbnail m-1 shadow-sm">
        </label>

        <button 
            type="button" 
            class="btn btn-primary btn-sm px-4 mx-2 my-1 mt-2"  
            data-toggle="modal" 
            data-type="image-gallery"
            data-target="#{{ $targetModalName }}"
            data-input="#{{ $inputId }}"
            data-mode="{{ $mode }}"
            >Выбрать
        </button>
        <button 
            id="input-image-delete-btn"
            type="button" 
            class="btn btn-outline-danger btn-sm px-4 mx-2 my-1 mt-2"  
            >Удалить
        </button>

    </div>

</div>

@push('modals')
    <x-modals.gallery 
        :name="$targetModalName"
    />  
@endpush
