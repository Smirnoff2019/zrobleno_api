@forelse($images as $key => $image)
<div class="modal-gallery-item">
    <input 
        id="g_image-{{ $image->id }}" 
        data-id="{{ $image->id }}" 
        value='@json($image->toArray())' 
        type="{{ $type ?? 'radio' }}" 
        name="g_image[]"
        >
    <label 
        for="g_image-{{ $image->id }}"
        style="background-image: url('{{ $image->file->url }}');"
        class="border m-0"
    >
        <span class="checkmark"></span>
    </label>
</div>
@empty
    <p class="text-center text-muted my-5 font-w-400" style="grid-column-start: span 4;"><i class="far fa-frown fa-2x"></i> <br> Not found</p>
@endforelse
