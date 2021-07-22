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
    style="width: 30rem;"
>
    <div class="card-body">
        <h5 class="card-title {{ $isActive ? 'text-white' : 'text-primary' }} d-flex justify-content-between">
            {{ $record->name }}
            @switch($record->status->type)

                @case('active')
                    <span class="
                            border 
                            px-2 py-1 ml-2 
                            mb-auto 
                            rounded 
                            fs-2 
                            @if($isActive)
                                text-success 
                                alert-success 
                                border-success
                            @else
                                text-success 
                                border-success
                            @endif
                        "
                    >
                        {{ $record->status->name }}
                    </span>
                    @break

                @case("inactive")
                    <span class="
                            border 
                            px-2 py-1 ml-2 
                            mb-auto 
                            rounded 
                            fs-2 
                            @if($isActive)
                                text-danger 
                                alert-danger 
                                border-danger
                            @else
                                text-danger 
                                border-danger
                            @endif
                        "
                    >
                        {{ $record->status->name }}
                    </span>
                    @break

                @default
                    
            @endswitch
        </h5>
        <p class="card-text ">
            <span>Коефіцієнт:</span>
            <span class="{{ $isActive ? 'text-white' : 'text-primary' }}">{{$record->value }}</span>
        </p>
    </div>
</a>