@extends('layouts.table')

@section('filters')

    @inject('Category', 'App\Models\Category\BlogCategory')
    <x-filters.choose
            label="Категория"
            default="Выбрать категорию"
            name="category_id"
            :value="$request->get('category_id', '')"
    >
        @include('admin.posts._depth-iterator-options', [
            'items' => $Category->whereNull('parent_id')->latest()->get(),
        ])
    </x-filters.choose>

@endsection

@section('thead')
    <th scope="col" class="bg-light">Обложка</th>
    <th scope="col">Заголовок</th>
    <th scope="col">Ярлык</th>
    <th scope="col">Описание</th>
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
                    :label="$record->title"
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
