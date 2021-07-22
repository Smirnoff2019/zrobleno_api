{{-- @foreach($records as $key => $image)
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
            <img src="{{ $image->file->url }}" alt="" class="">
        </label>
    </div>
</div>
@endforeach --}}

@each('includes.gallery-image-card', $records, 'image', 'includes.empty')
