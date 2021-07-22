@extends('layouts.table-v2')

@section('filters')
    
    @include('includes.filters.perPage')

    @include('includes.filter', [
        'name' => 'room_id',
        'label' => 'Кімната',
        'keys' => $rooms->pluck('name', 'id')
    ])
    
    @include('includes.filters.status')

    @include('includes.filters.sortBy', ['keys' => [
        'latest' => 'Спочатку нові',
        'oldest' => 'Спочатку старі',
    ]])

    @include('includes.filters.searchBy', [
        'columns' => [
            'name' => 'Назва',
            'slug' => 'Ярлик'
        ],
        'datalist' => $records->toQuery()->getModel()->select('name')->distinct()->pluck('name')
    ])

@endsection

@push('header-title')
    @if($routes->create)
        <a href="{{ route($routes->create) }}" class="rounded-sm btn btn-sm btn-light border-silver px-3 ml-2">Додати сторінку</a>
    @endif
@endpush
@section('thead')
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1 " width="10">№</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1 border-right border-left" width="10">Обкладинка</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Назва</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Ярлик</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Кімната</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Позиція</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="250">Статус</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="230">Створено</th>
@endsection

@section('tbody')
@parent
    @forelse($records ?? [] as $record)
        <tr class="">
            
            {{-- iteration --}}
            <th scope="row" class="font-w-500 text-monospace text-nowrap text-center">
                {{ $loop->iteration }}
            </th>
            
            {{-- image --}}
            <x-table.column-type.image 
                width="10"
                class="border-right border-left"
                :url="$record->image->url ?? ''"
            />
            
            {{-- name --}}
            <x-table.column-type.action 
                class="font-w-500 d-inline-block text-nowrap"
                :id="$record->id"
                :label="$record->name"
                :editRoute="$routes->edit"
                :destroyRoute="$routes->destroy"
            />

            {{-- slug --}}
            <td class="text-nowrap">
                @isset($record->slug)
                    {{ $record->slug ?? '' }}
                @endisset
                @empty($record->slug)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>

            {{-- room --}}
            <td class="text-nowrap">
                @isset($record->room)
                    <div class="btn-group dropright">
                        <a href="#" target="_blank" class="relation-link dropdown-toggle" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                            {{ $record->room->name }} 
                        </a>
                        <div class="dropdown-menu fade">
                            <a class="dropdown-item text-primary bg-white" href="{{ route('admin.rooms.edit', ['room' => $record->room->id]) }}">Открыть</a>
                            <a class="dropdown-item text-primary bg-white" href="{{ route('admin.rooms.edit', ['room' => $record->room->id]) }}" target="blank">Открыть в новой вкладке</a>
                        </div>
                    </div>
                @else
                    <span class="text-muted-vp small">Not found</span>
                @endif
            </td>
            
            {{-- sort --}}
            <td class="text-nowrap">
                @isset($record->sort)
                    {{ $record->sort ?? '' }}
                @endisset
                @empty($record->sort)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>

            {{-- status --}}
            <x-table.column-type.status 
                class=""
                :status="$record->status ?? null"
            />

            {{-- created_at --}}
            <td>
                @isset($record->created_at)
                    <span class="text-monospace text-nowrap"><i class="far fa-clock text-muted fs-2"></i> {{ $record->created_at->format('d.m.Y H:m') }}</span>
                @endisset
                @empty($record->created_at)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>

        </tr>
    @empty
        <tr>
            <td colspan="7">
                <p class="text-center text-danger my-4">Жодного запису не знайдено</p>
            </td>
        </tr>
    @endforelse
@endsection

@section('scripts')
    
@endsection
