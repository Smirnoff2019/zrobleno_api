@php
    $url = route($routes->edit, $record->id);
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
    style="width: 40rem;"
>
    <div class="card-body">
        {{ $record->complaint }}
        <h5 class="card-title {{ $isActive ? 'text-white' : 'text-primary' }} d-flex justify-content-between">
            {{ $record->subject }}
            @switch($record->status->type)

                @case('in_processing')
                <span class="border px-2 py-1 ml-2 mb-auto rounded fs-2 {{ $isActive ? 'text-primary alert-primary border-primary' : 'text-primary border-primary' }}">{{ $record->status->name }}</span>
                @break

                @case("processed")
                <span class="border px-2 py-1 ml-2 mb-auto rounded fs-2 {{ $isActive ? 'text-info alert-info border-info' : 'text-info border-info' }}">{{ $record->status->name }}</span>
                @break

                @case("satisfied")
                <span class="border px-2 py-1 ml-2 mb-auto rounded fs-2 {{ $isActive ? 'text-success alert-success border-success' : 'text-success border-success' }}">{{ $record->status->name }}</span>
                @break

                @case("rejected")
                <span class="border px-2 py-1 ml-2 mb-auto rounded fs-2 {{ $isActive ? 'text-danger alert-danger border-danger' : 'text-danger border-danger' }}">{{ $record->status->name }}</span>
                @break

                @default

            @endswitch
        </h5>
        <p class="card-text fs-3"></p>
        <p class="card-text fs-3 text-justify">{{ Str::limit($record->message, 180, '...') }}</p>
        <div class="card-text fs-2 d-flex justify-content-between">
            <span class="{{ $isActive ? 'text-white' : 'text-primary' }}">{{ $record->user->full_name ?? '' }}</span>
            <span>{{ $record->created_at }}</span>
        </div>
    </div>
</a>
