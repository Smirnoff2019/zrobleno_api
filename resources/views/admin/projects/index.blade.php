@extends('layouts.table-v2')

@section('filters')

        @include('includes.filters.perPage')
        
        @include('includes.filter', [
            'name' => 'region_id',
            'label' => 'Область',
            'keys' => $regions->pluck('name', 'id')
        ])
        
        @include('includes.filter', [
            'name' => 'walls_condition_id',
            'label' => 'Стан стін',
            'keys' => $walls_conditions->pluck('name', 'id')
        ])
        
        @include('includes.filter', [
            'name' => 'ceiling_height_id',
            'label' => 'Висота стелі',
            'keys' => $ceiling_heights->pluck('name', 'id')
        ])
        
        @include('includes.filter', [
            'name' => 'property_condition_id',
            'label' => 'Стан об’єкту',
            'keys' => $property_conditions->pluck('name', 'id')
        ])
        
        @include('includes.filters.status')
        
        @include('includes.filters.sortBy', [
            'keys' => [
                'latest' => 'Спочатку нові',
                'oldest' => 'Спочатку старі',
            ]
        ])
        
        @include('includes.filters.searchBy', [
            'columns' => [
                'uid' => 'UID',
                'city' => 'Місто'
            ]
        ])

@endsection

@push('header-title')
    @if($routes->create)
        <a href="{{ route($routes->create) }}" class="rounded-sm btn btn-sm btn-light border-silver px-3 ml-2">Додати проект ремонту</a>
    @endif
@endpush

@section('thead')
    <th scope="row" class="py-2 text-nowrap font-w-500 border-w-1" width="10">#</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Статус</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">UID</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Заг. площа</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Ціна</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Ціна за м<sup>2</sup></th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Місто</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Область</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Стан стін</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Стан об’єкту</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Висота стелі, <small class="text-muted">(м)</small></th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Замовник</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="230">Дата</th>
@endsection

@section('tbody')
@parent
    @forelse($records ?? [] as $record)
    <tr class="">

        <th scope="row"  class="text-monospace text-muted" width="10">{{ $loop->iteration }}</th>
        
        {{-- status --}}
        <x-table.column-type.status 
            class="col-auto"
            :status="$record->status ?? null"
        />

        {{-- uid --}}
        <x-table.column-type.action 
            class="font-w-500 d-inline-block text-nowrap"
            :id="$record->id"
            label="#{{ $record->uid }}"
            :editRoute="$routes->edit"
            {{-- :destroyRoute="$routes->destroy" --}}
        />

        {{-- total_area --}}
        <td class="text-nowrap">
            @isset($record->total_area)
                <span class="text-monospace font-w-500">{{ $record->total_area ?? 0 }}</span> 
                <span class="text-muted fs-2">м<sup>2</sup></span>
            @endisset
            @empty($record->total_area)
                <span class="text-muted-vp small">Not found</span>
            @endempty
        </td>
        
        {{-- total_price --}}
        <td class="text-nowrap">
            <p class=" mb-0">
                <span class="font-w-500">{{ number_format($record->total_price ?? 0, 0, '.', ' ') }}</span>
                <span class="text-muted fs-2 ml-1">грн.</span>
            </p>
        </td>
        
        {{-- price_per_area --}}
        <td class="text-nowrap">
            <p class=" mb-0">
                <span class='text-info font-w-500'>{{ number_format($record->price_per_area ?? 0, 0, '.', ' ') }}</span>
                <span class='text-muted fs-2 ml-1'>грн/м<sup>2</sup></span>
            </p>
        </td>
        
        {{-- city --}}
        <td class="text-nowrap">
            @isset($record->city)
                {{ $record->city ?? 0 }}
            @endisset
            @empty($record->city)
                <span class="text-muted-vp small">Not found</span>
            @endempty
        </td>

        {{-- region --}}
        <td class="text-nowrap">
            @isset($record->region)
                <a href="{{ 
                    route(
                        $routes->index, 
                        request()->merge(['region_id' => $record->region->id])->all()
                    )
                }}" title="Фільтрувати по регіону {{ $record->region->name }}">{{ $record->region->name }}</a>
            @endisset
            @empty($record->region)
                <span class="text-muted-vp fs-2">Not found</span>
            @endempty
        </td>

        {{-- wallsCondition --}}
        <td class="text-nowrap">
            @isset($record->wallsCondition)
                <a href="{{ route( $routes->index, request()->merge(['wallsCondition_id' => $record->wallsCondition->id])->all() ) }}" title="Фільтрувати по стан стін {{ $record->wallsCondition->name }}">{{ $record->wallsCondition->name }}</a>
            @endisset
            @empty($record->wallsCondition)
                <span class="text-muted-vp small">Not found</span>
            @endempty
        </td>

        {{-- propertyCondition --}}
        <td class="text-nowrap">
            @isset($record->propertyCondition)
                <a href="{{ route(
                    $routes->index, 
                    request()->merge(['propertyCondition_id' => $record->propertyCondition->id])->all()
                )}}" title="Фільтрувати по стан об’єкту {{ $record->propertyCondition->name }}">{{ $record->propertyCondition->name }}</a>
            @endisset
            @empty($record->propertyCondition)
                <span class="text-muted-vp small">Not found</span>
            @endempty
        </td>

        {{-- ceilingHeight --}}
        <td class="text-nowrap">
            @isset($record->ceilingHeight)
                <a href="{{ route(
                    $routes->index, 
                    request()->merge(['ceilingHeight_id' => $record->ceilingHeight->id])->all()
                )}}" title="Фільтрувати по висота стелі {{ $record->ceilingHeight->name }}">{{ $record->ceilingHeight->name }}</a>
            @endisset
            @empty($record->ceilingHeight)
                <span class="text-muted-vp small">Not found</span>
            @endempty
        </td>

        {{-- user --}}
        <td class="text-nowrap">
            @isset($record->user)
                <a href="{{ route(
                    $routes->index, 
                    request()->merge(['user_id' => $record->user->id])->all()
                )}}" title="Фільтрувати по замовнику {{ $record->user->full_name }}">{{ $record->user->full_name }}</a>
            @endisset
            @empty($record->user)
                <span class="text-muted-vp small">Not found</span>
            @endempty
        </td>

        {{-- created_at --}}
        <td class="text-nowrap">
            @isset($record->created_at)
                <span class="text-monospace text-nowrap"><i class="far fa-clock text-muted fs-2"></i> {{ $record->created_at }}</span>
            @endisset
            @empty($record->created_at)
                <span class="text-muted-vp small">Not found</span>
            @endempty
        </td>

    </tr>
    @empty
        <tr>
            <td colspan="13">
                <p class="text-center text-danger my-4">Жодного запису не знайдено</p>
            </td>
        </tr>
    @endforelse
@endsection

