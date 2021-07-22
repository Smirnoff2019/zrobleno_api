<div 
    role="alert" 
    {{ $attributes->merge(['class' => "shadow-sm mb-4 alert alert-$type"]) }}
>
    @if($asList)
        <ul class="my-2 pl-4">
            @foreach($message as $key => $value)
                <li>{{ $value }}</li>        
            @endforeach
        </ul>
    @else
        <b>{{ $message }}</b>
    @endif
</div>