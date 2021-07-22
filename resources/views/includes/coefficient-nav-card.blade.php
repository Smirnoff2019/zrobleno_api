@php
    // $isActive = Route::current()->getName() == $edit_route;
    
    $url = route($edit_route, $record->id);
    $isActive = request()->url() === $url;
@endphp
<a  href="{{ $isActive ? '#' : $url }}" 
    class=" card 
            list-group-item list-group-item-action 
            p-0 mb-1 
            shadow-sm 
            border border-hover border-hover-primary 
            @if($isActive)
                bg-primary
                border-primary 
                text-white
                active
            @else
                bg-white 
            @endif
        " 
    style="width: 30rem;"
>
    <div class="card-body">
        <h5 class="card-title {{ $isActive ? 'text-white' : 'text-primary' }} d-flex justify-content-between">
            {{ $record->name }}
            @switch($record->status->type)

                @case('active')
                    <span class="border px-2 py-1 ml-2 mb-auto rounded fs-2 {{ $isActive ? 'text-success alert-success border-success' : 'text-success border-success' }}">{{ $record->status->name }}</span>
                    @break

                @case("inactive")
                    <span class="border px-2 py-1 ml-2 mb-auto rounded fs-2 {{ $isActive ? 'text-danger alert-danger border-danger' : 'text-danger border-danger' }}">{{ $record->status->name }}</span>
                    @break

                @default
                    
            @endswitch
        </h5>
        <p class="card-text fs-2">{{ $record->description }}</p>
    </div>
</a>