<div class="images-gallery-item shadow p-1">
    <div class="custom-control custom-checkbox m-0 p-0 h-100 w-100  ">
        <input 
            type="checkbox" 
            class="custom-control-input" 
            id="customCheck{{ $key }}"
            name="images[]"
            value="{{ $image->id }}"    
        >
        <label 
            class="custom-control-label h-100 w-100 p-0 m-0 hover-thumbnail hover-primary" 
            for="customCheck{{ $key }}"
        >
            <img src="{{ $image->url }}" alt="{{ $image->name }}" class="" title="{{ $image->title }}">
            <div class="position-absolute fixed-bottom p-2 options">
                <a href="{{ route('admin.images.edit', $image->id) }}" title="Редактировать изображение" class="btn btn-primary* btn-info border d-flex justify-content-center align-items-center shadow"><i class="fas fa-pen"></i></a>
                <a href="#edit-image-frame" title="Редактировать изображение" class="open-image-edit-form-iframe-btn btn btn-primary* btn-primary border d-flex justify-content-center align-items-center shadow" data-toggle="modal" data-endpoint="{{ route('admin.api.images.make-modal-edit-form', $image->id) }}"><i class="fas fa-pen"></i></a>
            </div>
        </label>
        
    </div>
</div>
