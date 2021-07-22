{{-- @props(['records' => [], 'level' => 0]) --}}

@forelse($items as $item)
    <option
            value="{{ $item->id }}"
            @if($request->get('category_id', null) == $item->id)
            selected=""
            @endif
            @if($request->get('category_id', null) == $item->id)
            disabled=""
            @endif
    >
        {{ $delimiter ?? '' }}{{ $item->name ?? '' }}
    </option>
    @isset($item->children)
        @include('admin.posts._depth-iterator-options', [
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
