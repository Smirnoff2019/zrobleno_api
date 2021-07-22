<ol class="breadcrumb border border-silver my-4">
    @foreach($list as $key => $item)
        <li class="breadcrumb-item @if($loop->last) active @endif">
            @if($loop->last)
            {{ $item['label'] ?? '' }}
            @else
            <a href="{{ $item['route'] ?? '#' }}">{{ $item['label'] ?? '' }}</a>
            @endif
        </li>
    @endforeach
</ol>