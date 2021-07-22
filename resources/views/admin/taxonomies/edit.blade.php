@extends('layouts.edit')

@section('container-class', 'container')

@section('card-header')
    <x-form-title>Редактировать <span class="text-muted small"> [{{ Breadcrumbs::currentTitle() }}]</span></x-form-title>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
    
        <x-form-nav-tab name="nav-1" label="Основное" active="true" />

    </div>
@endsection

@section('form')

    @inject('statuses', 'App\Services\Blade\StatusesService')
{{--    @inject('Category', 'App\Models\Category\Category')--}}

    <div class="tab-content p-1" id="nav-tabContent">

        {{-- TAB 1 --}}
        <x-form-nav-tab-content name="nav-1" active="true" >

            <x-input
                type="text"
                label="Название:"
                name="name"
                :value="old('name') ?? $record->name"
                placeholder="Введите название...">
            </x-input>

            <x-input
                type="text"
                label="Ярлык:"
                name="slug"
                :value="old('slug') ?? $record->slug"
                placeholder="Введите ярлык...">
            </x-input>

            <x-textarea
                label="Описание:"
                name="description"
                :value="old('description') ?? $record->description"
                placeholder="Введите описание...">
            </x-textarea>

            <x-select
                label="Статус:"
                name="status_id"
                :value="old('status_id') ?? $record->status_id"
                :options="$statuses->common()">
            </x-select>

        </x-form-nav-tab-content>
        {{-- end TAB 1 --}}

    </div>

@endsection

@section('scripts')
    
@endsection
