<td {{ $attributes->only(['width']) }}>
    @if($isEmpty())
    <span {{ $attributes->merge(['class' => "text-muted-vp small"]) }}>Not found</span>
    @else
    <span {{ $attributes->merge(['class' => "status-badge badge-$state"]) }}>{{ $label }}</span>
    @endif
</td>