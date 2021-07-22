@extends('layouts.create')

@section('container-class', 'container')

@section('card-header')
    <x-form-title>{{ Breadcrumbs::currentTitle('', 'категорию') }}</x-form-title>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">

        <x-form-nav-tab
                name="nav-1"
                label="Основное"
                active="true">
        </x-form-nav-tab>

    </div>
@endsection

@section('form')

    <div class="tab-content p-1" id="nav-tabContent">

        {{-- TAB 1 --}}
        <x-form-nav-tab-content name="nav-1" active="true" >

            <x-input
                    type="text"
                    label="Название:"
                    name="name"
                    :value="old('name')"
                    placeholder="Введите название...">
            </x-input>

            <x-input
                    type="text"
                    label="Ярлык:"
                    name="slug"
                    :value="old('slug')"
                    placeholder="Введите ярлык..."
                    data-slugify="input#name">
            </x-input>

            <x-textarea
                    label="Описание:"
                    name="description"
                    :value="old('description')"
                    placeholder="Введите описание...">
            </x-textarea>

            @inject('Category', 'App\Models\Category\BlogCategory')
            <x-select
                    label="Родительская категория:"
                    name="parent_id"
                    :value="old('parent_id')"
            >
                <x-select-option
                        label="-- без родительской категории --"
                        value=""
                        :selected="!(old('parent_id'))">
                </x-select-option>
                @include('admin.posts.categories._depth-iterator-options', [
                    'items' => $Category->whereNull('parent_id')->latest()->get()
                ])
            </x-select>

            @inject('statuses', 'App\Services\Blade\StatusesService')
            <x-select
                    label="Статус:"
                    name="status_id"
                    :value="old('status_id')"
                    :options="$statuses->common()">
            </x-select>

            <x-input-image
                    label="Обложка:"
                    name="image_id"
                    value=""
                    mode="single">
            </x-input-image>

        </x-form-nav-tab-content>
        {{-- end TAB 2 --}}

    </div>
@endsection

@section('scripts')

@endsection
