{{-- Field Controls --}}
<div class="col my-1">
    <div class="d-flex align-items-center">

        {{-- <div class="meta-field-card-header--iteration border fs-2 mr-3">
            {{ $iteration }}
        </div> --}}
        <div class="meta-field-card-header--iteration fs-2 mr-1 ml-n3 text-muted-vp cursor-move ui-draggable-control">
            <i class="fas fa-ellipsis-v"></i>
        </div>

        {{ $slot }}

    </div>
</div>