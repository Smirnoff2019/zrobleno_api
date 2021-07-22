<td {{ $attributes }}>
    {{ $slot }}
    @empty ($slot)
        <span class="text-muted-vp small">Not found</span>
    @endempty
</td>