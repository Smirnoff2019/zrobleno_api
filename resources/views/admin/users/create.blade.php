@extends('layouts.create')

@section('container-class', 'container')

@section('card-header')
    <h3 class="mb-4">{{ $label ?? 'Додати користувача' }}</h3>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
    
	<x-form-nav-tab
		name="nav-1"
		label="Основне"
		active="true">
	</x-form-nav-tab>

    </div>
@endsection

@section('form')

    @inject('statuses', 'App\Services\Blade\StatusesService')
	@inject('roles', 'App\Services\Blade\RolesService')

    <div class="tab-content p-1" id="nav-tabContent">

	{{-- TAB 1 --}}
	<x-form-nav-tab-content name="nav-1" active="true" >

		<x-input-image
			label="Аватар:"
			name="image_id"
			value=""
			mode="single">
		</x-input-image>

		<x-input
			type="text"
			label="Прізвище:"
			name="last_name"
			:value="old('last_name')"
			placeholder="Введіть прізвище...">
		</x-input>

		<x-input
			type="text"
			label="Ім'я:"
			name="first_name"
			:value="old('first_name')"
			placeholder="Введіть ім'я...">
		</x-input>

		<x-input
			type="text"
			label="Побатькові:"
			name="middle_name"
			:value="old('middle_name')"
			placeholder="Введіть побатькові...">
		</x-input>

		<x-input
			type="number"
			label="Контактний телефон:"
			name="phone"
			:value="old('phone')"
			placeholder="Введіть номер телефону">
		</x-input>

		<x-input
			type="email"
			label="E-mail:"
			name="email"
			:value="old('email')"
			placeholder="Введіть E-mail адресу">
		</x-input>
		
		<x-select
			label="Статус:"
			name="status_id"
			:value="old('status_id')"
			:options="$statuses->common()">
		</x-select>

		<x-select
				label="Роль:"
				name="role_id"
				:value="old('role_id')"
				:options="$roles->getRole()">
		</x-select>

	</x-form-nav-tab-content>
	{{-- end TAB 1 --}}

    </div>

@endsection

@section('scripts')
    
@endsection
