<td class="" {{ $attributes->only('width') }}>
    <div class="d-flex">
        @if($labelBefore)
        <span class="float-left text-monospace mr-2 text-muted-vp text-nowrap">{{ $labelBefore }}</span>
        @endif
        <div>
            <p {{ $attributes->merge(['class' => "p-0 mb-1"])->except(['width']) }}>
                <a href="{{ $editUrl ?? '#' }}"> {!! $label !!}</a>
                @unless($label)
                <span class="text-muted-vp small">Not found</span>
                @endunless
            </p>
            <div {{ $attributes->merge(['class' => "d-flex w-100 row-action"]) }}>
        
                @if($editUrl)
                    <a href="{{ $editUrl }}" class="action-link fs-2">Редактировать</a>
                @endif
        
                @if($destroyUrl)
                    <span class="mx-1 mr-2 fs-1 text-muted-vp" style="margin-top: 2px;">|</span>
                    <button form="delete-record-{{ $id }}" class="text-danger p-0 border-0 action-link bg-transparent fs-2" type="submit">Удалить</button>
                    <form id="delete-record-{{ $id }}" action="{{ $destroyUrl }}" method="POST" class="p-0 m-0 action-cell--delete-record">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
        
            </div>
        </div>
    </div>
</td>