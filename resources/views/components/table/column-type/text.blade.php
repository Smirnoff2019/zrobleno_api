<td {{ $attributes->only('width') }}>
    {{ $value }}
    @unless ($value || $value === 0)
    <span {{ $attributes->merge(['class' => "text-muted-vp small"]) }}>Not found</span>
    @endunless
</td>