@extends('layouts.table')

@section('thead')
    <th scope="col">Название</th>
    <th scope="col">Ярлык</th>
    <th scope="col">Описание</th>
    <th scope="col">Статус</th>
@endsection

@section('tbody')
    @forelse($records ?? [] as $index => $record)
        <tr>
            <th scope="row"  class="border-right">{{ $index + 1 }}</th>

            <x-table.column-type.action 
                :id="$record->id"
                :label="$record->name"
                :editRoute="$routes->edit"
                :destroyRoute="$routes->destroy">
            </x-table.column-type.action>
            
            <x-table.column-type.text 
                :value="$record->slug ?? ''">
            </x-table.column-type.text>
            
            <x-table.column-type.text 
                width="600"
                :value="Str::limit($record->description ?? '', 150)">
            </x-table.column-type.text>
            
            <x-table.column-type.status 
                :status="$record->status ?? null">
            </x-table.column-type.status>

        </tr>
        @empty
            @section('after_table')
            <p class="text-center text-muted my-5">Not found...</p>
            @endsection

    @endforelse
@endsection
