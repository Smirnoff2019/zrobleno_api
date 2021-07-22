{{-- @props(['records' => [], 'level' => 0]) --}}

@forelse($records as $record)

    <tr>
        <th scope="row" class="tr-pagination border-right">{{ $loop->iteration ?? 0 }}</th>

        <x-table.column-type.image
                :url="$record->image->url ?? ''">
        </x-table.column-type.image>

        <x-table.column-type.action
                :id="$record->id"
                :label="$record->name"
                :editRoute="$routes->edit"
                :destroyRoute="$routes->destroy"
                :level="$level = $loop->depth-1"
                width="500">
        </x-table.column-type.action>

        <x-table.column-type.text
                :value="$record->slug ?? ''">
        </x-table.column-type.text>

        <x-table.column-type.text
                :value="$record->description ?? ''">
        </x-table.column-type.text>

        <x-table.column-type.status
                :status="$record->status ?? null">
        </x-table.column-type.status>

    </tr>

    @if($record->children && $level+=1)
        @include('admin.posts.categories._depth-iterator', ['records' => $record->children, 'level' => $level])
    @endif

@empty
    @once
@section('after_table')
    <p class="text-center text-muted my-5">Not found...</p>
@endsection
@endonce
@endforelse
