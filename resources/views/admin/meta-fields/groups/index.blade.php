@extends('layouts.table')

@section('filters')

@endsection

@section('thead')
    <th scope="col">Назва</th>
    <th scope="col">Ярлык</th>
    <th scope="col">Описание</th>
@endsection

@section('tbody')
    @forelse($records ?? [] as $record)
        <tr>
            <th scope="row"  class="border-right">{{ $loop->iteration }}</th>

            <x-table.column-type.action 
                :id="$record->id"
                :label="$record->name"
                :editRoute="$routes->edit"
                :destroyRoute="$routes->destroy"
            />
            
            <x-table.column-type.text 
                :value="$record->slug ?? ''"
            />
            
            <x-table.column-type.text 
                width="600"
                :value="Str::limit($record->description ?? '', 150)"
            />

        </tr>
    @empty
        @section('after_table')
        <p class="text-center text-muted my-5">Not found...</p>
        @endsection
    @endforelse
@endsection
