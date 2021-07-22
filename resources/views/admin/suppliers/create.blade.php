@extends('layouts.create')

@section('container-class', 'container')

@section('card-header')
    <h3 class="mb-4">{{ $label ?? 'Додати постачальника' }}</h3>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">

		<x-form-nav-tab
			name="nav-1"
			label="Постачальник"
			active="true">
		</x-form-nav-tab>

		<x-form-nav-tab
			name="nav-2"
			label="Знижка для замовника">
		</x-form-nav-tab>

		<x-form-nav-tab
			name="nav-3"
			label="Знижка для підрядника">
		</x-form-nav-tab>

    </div>
@endsection

@section('form')

    @inject('statuses', 'App\Services\Blade\StatusesService')

    <div class="tab-content p-1" id="nav-tabContent">

		{{-- TAB 1 --}}
		<x-form-nav-tab-content name="nav-1" active="true" >

			<x-input
				type="text"
				label="Назва компанії:"
				name="name"
				:value="old('name')"
				placeholder="Введіть назву компанії...">
			</x-input>

			<x-textarea
				label="Короткі відомості:"
				name="description"
				:value="old('description')"
				placeholder="Введіть відомості...">
			</x-textarea>

			<x-input
				type="url"
				label="Каталог товарів:"
				name="catalog_url"
				:value="old('catalog_url')"
				placeholder="https://www.google.com"
				required>
			</x-input>

			<x-input-image
				label="Логотип компанії:"
				name="image_id"
				value=""
				mode="single">
			</x-input-image>

			<x-select
				label="Статус:"
				name="status_id"
				:value="old('status_id')"
				:options="$statuses->common()">
			</x-select>

		</x-form-nav-tab-content>
		{{-- end TAB 1 --}}

		{{-- TAB 2 --}}
		<x-form-nav-tab-content name="nav-2" >

			<x-input
				type="text"
				label="Знижка у відсотках:"
				name="customers_discount[value]"
				:value="old('customers_discount[value]')"
				placeholder="3"
				required>
			</x-input>

			<x-input
				type="date"
				label="Термін дії:"
				name="customers_discount[expirated_at]"
				:value="old('customers_discount[expirated_at]')"
				placeholder="10"
				required>
			</x-input>

			<x-select
				label="Статус:"
				name="customers_discount[status_id]"
				:value="old('customers_discount[status_id]')"
				:options="$statuses->common()"
				required>
			</x-select>

		</x-form-nav-tab-content>
		{{-- end TAB 2 --}}

		{{-- TAB 3 --}}
		<x-form-nav-tab-content name="nav-3" >

			<x-input
				type="text"
				label="Знижка у відсотках:"
				name="contractors_discount[value]"
				:value="old('contractors_discount[value]')"
				placeholder="10"
				required>
			</x-input>

			<x-input
				type="date"
				label="Термін дії:"
				name="contractors_discount[expirated_at]"
				:value="old('contractors_discount[expirated_at]')"
				placeholder="10"
				required>
			</x-input>

			<x-select
				label="Статус:"
				name="contractors_discount[status_id]"
				:value="old('contractors_discount[status_id]')"
				:options="$statuses->common()"
				required>
			</x-select>

		</x-form-nav-tab-content>
		{{-- end TAB 3 --}}

    </div>

@endsection

@section('scripts')
    
@endsection
