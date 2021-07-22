@extends('layouts.table')

@section('filters')

    @inject('Role', 'App\Models\Role\Role')
    <x-filters.choose
            label="Роль користувача"
            default="Обрати роль користувача"
            name="role_id"
            :value="$request->get('role_id', '')"
    >
        @include('admin.users._depth-iterator-options', [
            'items' => $Role->get(),
        ])
    </x-filters.choose>

@endsection

@section('thead')
	<th scope="col" class="bg-light">Аватар</th>
	<th scope="col">Прізвище</th>
	<th scope="col">Ім'я</th>
	<th scope="col">Побатькові</th>
	<th scope="col">Телефон</th>
	<th scope="col">Пошта</th>
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
				:label="$record->last_name"
				:editRoute="$routes->edit"
				:destroyRoute="$routes->destroy">
			</x-table.column-type.action>

			<x-table.column-type.text
				:value="$record->first_name ?? ''">
			</x-table.column-type.text>

			<x-table.column-type.text
				:value="$record->middle_name ?? ''">
			</x-table.column-type.text>

			<x-table.column-type.text
				:value="$record->phone ?? ''">
			</x-table.column-type.text>

			<x-table.column-type.text
				:value="$record->email ?? ''">
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
