@extends('layouts.table')

@section('thead')
    <th scope="col" class="bg-light">Обложка</th>
    <th scope="col">Название</th>
    <th scope="col">Ярлык</th>
    <th scope="col">Описание</th>
    <th scope="col">Статус</th>
@endsection

@section('tbody')
@parent
    @foreach($records ?? [] as $index => $record)
        @include('admin.categories.index-table-row', ['record' => $record, 'index' => $index, 'level' => 0])
    @endforeach
@endsection
