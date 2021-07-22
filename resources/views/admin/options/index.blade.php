@extends('layouts.table-v2')

@section('filters')

    @include('includes.filters.perPage')

    @include('includes.filter', [
        'name' => 'room_id',
        'label' => 'Кімната',
        'keys' => $rooms->pluck('name', 'id')
    ])

    @include('includes.filter', [
        'name' => 'options_group_id',
        'label' => 'Група',
        'groups' => $options_groups->load('room')->groupBy('room.name')->map(function ($group, $key) {
            return collect($group)->pluck('name', 'id');
        }),
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
        <a href="{{ route($routes->create) }}" class="rounded-sm btn btn-sm btn-light border-silver px-3 ml-2">Додати опцію</a>
    @endif
@endpush

@section('thead')
    <th scope="row" class="py-2 text-nowrap font-w-500 border-w-1" width="10">№</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1 border-right border-left" width="10">Рендер</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Назва</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Ярлик</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Ціна</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Кімната</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Група</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Позиція в групі</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Статус</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="230">Створено</th>
@endsection

@section('tbody')
@parent
    @forelse($records ?? [] as $record)
        <tr>
            
            {{-- id --}}
            <th scope="row" class="font-w-500 text-monospace text-nowrap text-center">
                {{ $loop->iteration }}
            </th>
            
            {{-- image --}}
            <x-table.column-type.image 
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


            {{-- price --}}
            <td class="text-nowrap">
                {{ number_format((int) $record->price ?? 0, 0, '.', ' ') }} грн.
            </td>

            {{-- room --}}
            <td class="text-nowrap">
                @isset($record->room)
                    <div class="btn-group dropright">
                        <a href="#" target="_blank" class="relation-link dropdown-toggle" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                            {{ $record->room->name }} 
                        </a>
                        <div class="dropdown-menu fade">
                            <a class="dropdown-item text-primary bg-white" href="{{ route('admin.rooms.edit', $record->room->id) }}">Відкрити</a>
                            <a class="dropdown-item text-primary bg-white" href="{{ $request->fullUrlWithQuery(['room_id' => $record->room->id]) }}" title="Фільтрувати по кімнаті">Фільтрувати по кімнаті</a>
                        </div>
                    </div>
                @endisset
                @empty($record->room)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>

            {{-- optionsGroup --}}
            <td class="text-nowrap">
                @isset($record->optionsGroup)
                    <div class="btn-group dropright">
                        <a href="#" target="_blank" class="relation-link dropdown-toggle" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                            {{ $record->optionsGroup->name }} 
                        </a>
                        <div class="dropdown-menu fade">
                            <a class="dropdown-item text-primary bg-white" href="{{ route('admin.options-groups.edit', $record->optionsGroup->id) }}">Відкрити</a>
                            <a class="dropdown-item text-primary bg-white" href="{{ $request->fullUrlWithQuery(['options_group_id' => $record->optionsGroup->id]) }}" title="Фільтрувати по кімнаті">Фільтрувати по групі</a>
                        </div>
                    </div>
                @endisset
                @empty($record->optionsGroup)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>
            
            {{-- sort --}}
            <td class="text-nowrap">
                {{ (int) $record->sort ?? 0 }}
            </td>
            
            {{-- status --}}
            <x-table.column-type.status 
                class="col-auto"
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
        @section('after_table')
            <p class="text-center text-muted my-5">Not found...</p>
        @endsection
    @endforelse
@endsection

