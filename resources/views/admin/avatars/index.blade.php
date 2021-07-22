@extends('layouts.table-v2')

@section('filters')

    @include('includes.filters.perPage')
    
    @include('includes.filter', [
        'name' => 'gender',
        'label' => 'Стать',
        'keys' => $genders,
    ])

    @include('includes.filter', [
        'name' => 'color',
        'label' => 'Колір',
        'keys' => $colors,
    ])

    @include('includes.filters.status')

    @include('includes.filters.sortBy', ['keys' => [
        'latest' => 'Спочатку нові',
        'oldest' => 'Спочатку старі',
    ]])

    @include('includes.filters.search', ['name' => 'name'])

@endsection

    @push('header-title')
    @if($routes->create)
        <a href="{{ route($routes->create) }}" class="rounded-sm btn btn-sm btn-light border-silver px-3 ml-2">Додати аватар</a>
    @endif
@endpush

@section('thead')
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="10">№</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1 border-right border-left" width="10">Аватар</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Назва</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Колір</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Стать</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Група</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Статус</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="230">Створено</th>
@endsection

@section('tbody')
@parent
    @forelse($records ?? [] as $record)
        <tr>
            
            {{-- id --}}
            <th scope="row" class="font-w-500 text-monospace text-nowrap text-center">
                @isset($record->id)
                    {{ $record->id }}
                @endisset
                @empty($record->id)
                    <span class="text-muted-vp">-</span>
                @endempty
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

            {{-- color --}}
            <td class="text-nowrap">
                @isset($record->color)
                    {{ $colors[$record->color] ?? '' }}
                @endisset
                @empty($record->color)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>

            {{-- gender --}}
            <td class="text-nowrap">
                @isset($record->gender)
                    {{ $genders[$record->gender] ?? '' }}
                @endisset
                @empty($record->gender)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>

            {{-- group --}}
            <td class="text-nowrap">
                @isset($record->group)
                    {{ $record->group ?? '' }}
                @endisset
                @empty($record->group)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
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

