{{-- meta-field-card --}}
<li {{ $attributes->merge(['class' => 'meta-field-card list-group-item  border-top p-0']) }}>
    <div class="d-flex flex-column">

        {{ $slot }}

    </div>
</li>