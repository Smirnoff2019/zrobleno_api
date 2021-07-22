@extends('layouts.create')

@section('container-class', 'container')

@section('card-header')
    <h3 class="mb-4">{{ $label ?? 'Создать публикацию' }}</h3>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
    
        <x-form-nav-tab
                name="nav-1"
                label="Основное"
                active="true">
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
                    label="Заголовок:"
                    name="title"
                    :value="old('title')"
                    placeholder="Введите заголовок...">
            </x-input>

            <x-input
                    type="text"
                    label="Ярлык:"
                    name="slug"
                    :value="old('slug')"
                    placeholder="Введите ярлык...">
            </x-input>

            <x-textarea
                    label="Описание:"
                    name="description"
                    :value="old('description')"
                    placeholder="Введите описание...">
            </x-textarea>

            <x-ckeditor
                    label="Контент:"
                    name="content"
                    placeholder="Введите контент..."
                    rows="15"
            >
                {{ old('content') }}
            </x-ckeditor>

            <x-input-image
                    label="Изображение:"
                    name="image_id"
                    value=""
                    mode="single">
            </x-input-image>

            @inject('Category', 'App\Models\Category\BlogCategory')
            <x-checkbox-group label="Категории:">
                <x-checkbox-group-children
                        labelIn="name"
                        valueIn="id"
                        childrenIn="children"
                        name="categories[]"
                        :masterValue="collect()"
                        :options="$Category->whereNull('parent_id')->latest()->get()">
                </x-checkbox-group-children>
            </x-checkbox-group>


            <x-select
                    label="Статус:"
                    name="status_id"
                    :value="old('status_id')"
                    :options="$statuses->common()">
            </x-select>

        </x-form-nav-tab-content>
        {{-- end TAB 1 --}}

    </div>

@endsection

@section('scripts')
    
@endsection
