{{-- Card Header --}}
<div {{ $attributes->merge(['class' => 'meta-field-card-header col-12']) }}>
    <div class="row mx-0 py-2">
        {{ $slot }}
    </div>
</div>