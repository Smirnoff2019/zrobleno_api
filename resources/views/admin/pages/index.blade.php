@extends('layouts.table-v2')

@section('filters')
    
    @include('includes.filters.perPage')

    @include('includes.filters.status')

    @include('includes.filters.sortBy', ['keys' => [
        'latest' => 'Спочатку нові',
        'oldest' => 'Спочатку старі',
    ]])

    @include('includes.filters.search', ['name' => 'title'])

@endsection

@push('header-title')
    @if($routes->create)
        <a href="{{ route($routes->create) }}" class="rounded-sm btn btn-sm btn-light border-silver px-3 ml-2">Додати сторінку</a>
    @endif
@endpush

@section('thead')
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1 " width="10">№</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1 border-right border-left" width="10">Обкладинка</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="350">Назва</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="650">Опис</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="250">Ярлик</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="250">Статус</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="230">Оновлено</th>
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
                width="100"
                class="border-right border-left"
                :url="$record->image->url ?? ''"
            />
            
            {{-- title --}}
            <x-table.column-type.action 
                class="font-w-500 d-inline-block text-nowrap"
                :id="$record->id"
                :label="$record->title"
                :editRoute="$routes->edit"
                :destroyRoute="$routes->destroy"
            />

            {{-- description --}}
            <td class="" >
                @isset($record->description)
                    {{ Str::limit($record->description, 150) }}
                @endisset
                @empty($record->description)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>

            {{-- slug --}}
            <td class="text-nowrap">
                @isset($record->slug)
                    {{ $record->slug ?? '' }}
                @endisset
                @empty($record->slug)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>
            
            {{-- status --}}
            <x-table.column-type.status 
                class=""
                :status="$record->status ?? null"
            />

            {{-- updated_at --}}
            <td>
                @isset($record->updated_at)
                    <span class="text-monospace text-nowrap"><i class="far fa-clock text-muted fs-2"></i> {{ $record->updated_at->format('d.m.Y H:m') }}</span>
                @endisset
                @empty($record->updated_at)
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

