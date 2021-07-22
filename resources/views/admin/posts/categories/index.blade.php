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

    @include('admin.posts.categories._depth-iterator')

@endsection
