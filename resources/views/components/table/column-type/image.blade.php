<td 
    class="{{ $attributes->merge(['class' => "bg-light text-center"])->get('class') }}" 
    width="{{ $attributes->get('width') ?? 10 }}"
>
    @if($url)
        <img src="{{ $url }}" alt="{{ $url }}" class=" {{ $attributes->merge(['img:class' => "border border-secondary w-100"])->get('img:class') }}">
    @else
        <span class="text-muted-vp small">Not found</span>
    @endif
</td>