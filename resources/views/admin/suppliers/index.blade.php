@extends('layouts.table')

@section('thead')
    <th scope="col" class="bg-light">Логотип</th>
    <th scope="col">Компанія</th>
    <th scope="col">Короткі Відомості</th>
    <th scope="col">Посилання на додатки</th>
    <th scope="col">Статус</th>
@endsection

@section('tbody')
    @forelse($records ?? [] as $record)
        <tr>
            <th scope="row"  class="border-right">{{ $loop->iteration }}</th>

            <x-table.column-type.image
                    :url="$record->image->url ?? ''">
            </x-table.column-type.image>

            <x-table.column-type.action
                    :id="$record->id"
                    :label="$record->name"
                    :editRoute="$routes->edit"
                    :destroyRoute="$routes->destroy">
            </x-table.column-type.action>

            <x-table.column-type.text
                    width="600"
                    :value="Str::limit($record->description ?? '', 150)">
            </x-table.column-type.text>

            <x-table.column-type.text
                    :value="$record->catalog_url ?? ''">
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
