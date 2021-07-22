@extends('layouts.table-v2')

@section('filters')
        
    @include('includes.filters.perPage')

    @include('includes.filters.status')
    
    @include('includes.filters.sortBy', ['keys' => [
        'latest' => 'Спочатку нові',
        'oldest' => 'Спочатку старі',
    ]])

    @include('includes.filters.search', ['name' => 'uid', 'type' => 'number', 'placeholder' => 'UID'])

@endsection

@section('thead')
    <th scope="row" class="py-2 text-nowrap font-w-500 border-w-1" width="10">№</th>
    <th scope="row" class="py-2 text-nowrap font-w-500 border-w-1" width="10">UID</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Назва</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Ціна</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Учасники</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Замовник</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1">Статус</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="230">Дата початку</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="230">Дата завершення</th>
    <th scope="col" class="py-2 text-nowrap font-w-500 border-w-1" width="230">Дата</th>
@endsection

@section('tbody')
@parent
    @forelse($records ?? [] as $record)
        <tr class="">
            
            {{-- iteration --}}
            <th scope="row" class="font-w-500 text-monospace text-nowrap text-center" width="10">
                {{ $loop->iteration }}
            </th>

            {{-- uid --}}
            <td scope="row" class="text-nowrap text-monospace">
                <span class="text-muted">#</span>{{ $record->uid }}
            </td>
            
            {{-- name --}}
            <x-table.column-type.action 
                class="font-w-500 d-inline-block text-nowrap"
                :id="$record->id"
                label="{{ $record->name }}"
                :editRoute="$routes->edit"
                :destroyRoute="$routes->destroy"
            />

            {{-- price --}}
            <td class="text-nowrap">
                <p class=" mb-0">
                    <span class="">{{ number_format($record->price ?? 0, 0, '.', ' ') }}</span>
                    <span class="text-muted fs-2 ml-1">грн/уч.</span>
                </p>
            </td>

            {{-- max_participants --}}
            <td class="text-nowrap">
                @isset($record->max_participants)
                {{ (int) $record->participants_count }}/{{ $record->max_participants }}
                @endisset
                @empty($record->max_participants)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>

            {{-- user --}}
            <td class="text-nowrap">
                @isset($record->user)
                    <a href="{{ route(
                        $routes->index, 
                        request()->merge(['user_id' => $record->user->id])->all()
                    )}}" title="Показати тендери замовника {{ $record->user->full_name }}">{{ $record->user->full_name }}</a>
                @endisset
                @empty($record->user)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>
            
            {{-- status --}}
            <x-table.column-type.status 
                class="col-auto"
                :status="$record->status ?? null"
            />

            {{-- started_at --}}
            <td>
                @isset($record->started_at)
                    <span class="text-monospace text-nowrap"><i class="far fa-clock text-muted fs-2"></i> {{ $record->started_at->format('d.m.Y') }}</span>
                @endisset
                @empty($record->started_at)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>

            {{-- finished_at --}}
            <td>
                @isset($record->finished_at)
                    <span class="text-monospace text-nowrap"><i class="far fa-clock text-muted fs-2"></i> {{ $record->finished_at->format('d.m.Y') }}</span>
                @endisset
                @empty($record->finished_at)
                    <span class="text-muted-vp small">Not found</span>
                @endempty
            </td>

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
            <td colspan="10">
                <p class="text-center text-danger my-4">Жодного запису не знайдено</p>
            </td>
        </tr>
    @endforelse
@endsection

