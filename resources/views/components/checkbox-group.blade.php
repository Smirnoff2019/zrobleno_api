@props([
    'label' => 'Not found...'
])
<div class="form-group 111">
    <label>{{ $label }}</label>
    <div class="bg-light border p-3 custom-cat-choise-field">
        
        @if($slot->isEmpty())
            <span class="text-muted">Not found...</span>
        @else
            <ul class="custom-control custom-checkbox mb-1">
                {{ $slot }}
            </ul>
        @endif

    </div>
</div>