@props([
    'target',
])

{{-- Field Name Label --}}
<div class="col my-1">
    <a {{ $attributes->merge([
            'class'         => 'meta-field-card-header--action nav-link text-primary p-0',
            'aria-expanded' => 'false',
            'aria-controls' => $target,
            'data-toggle'   => 'collapse',
            'href'          => "#$target",
            'role'          => "button"
        ]) }}>
        <strong class="meta-field-card-header--name">{{ $slot ?? "(not label)" }}</strong>     
    </a>
</div>