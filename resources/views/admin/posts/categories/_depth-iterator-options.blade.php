{{-- @props(['records' => [], 'level' => 0]) --}}

@forelse($items as $item)
    <option
            value="{{ $item->id }}"
            @isset($record->id)
            @if((old('parent_id') ?? $record->parent_id) == $item->id)
            selected=""
            @endif
            @if($record->id == $item->id)
            disabled=""
            @endif
            @endisset

    >
        {{ $delimiter ?? '' }}{{ $item->name ?? '' }}
    </option>
    @isset($item->children)
        @include('admin.posts.categories._depth-iterator-options', [
            'items' => $item->children,
            'delimiter' => ' - ' . ($delimiter ?? '')
        ])
    @endisset
@empty
    @once
@section('after_table')
    <p class="text-center text-muted my-5">Not found...</p>
@endsection
@endonce
@endforelse
