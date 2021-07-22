<tr class="images-gallery-item bg-white">
    <td scope="row" width="35" class="align-middle bg-light p-0 images-gallery-item--left-bar">
        <a role="button" class="iteration-counter border border-light mx-auto rounded-circle text-muted cursor-move ui-draggable-control" title="Переместить"></a>
    </td>
    <td class="images-gallery-item--body">
        <x-input-image 
            class="mb-0"
            name="{{ $name }}" 
            mode="single" 
            :url="$url ?? ''"
            :value="$value ?? ''"
            modal="modal-galery-for-meta"
        />
    </td>
    <td scope="row" width="35" class="align-middle bg-light p-0 images-gallery-item--right-bar">
        <span role="button" class="delete-image-from-gallery mx-auto" title="Удалить изображение"></span>
    </td>
</tr>
