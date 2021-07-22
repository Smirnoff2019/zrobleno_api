@extends('layouts.create')

@section('container-class', 'container')

@section('card-header')
    <x-form-title>{{ Breadcrumbs::currentTitle('', 'новое портфолио') }}</x-form-title>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
    
        <x-form-nav-tab name="nav-1" label="Основное" active="true" />
        <x-form-nav-tab name="nav-2" label="Мета дані"/>

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
                placeholder="Введите заголовок..."
            />

            <x-input 
                type="text" 
                label="Ярлык:" 
                name="slug" 
                :value="old('slug')" 
                placeholder="slug"
                data-slugify="input#title"
            />

            <x-textarea 
                label="Описание:" 
                name="description" 
                :value="old('description')" 
                placeholder="Введите описание..."
            />
                
            {{-- <x-ckeditor 
                label="Контент:" 
                name="content" 
                placeholder="Введите контент..."
                rows="15"
            >
                {{ old('content') }}
            </x-ckeditor> --}}

            <x-input-image 
                label="Изображение:" 
                name="image_id" 
                value="" 
                mode="single" 
            />

            @inject('Category', 'App\Models\Category\PortfolioCategory')
            <x-checkbox-group label="Категории:">
                <x-checkbox-group-children 
                    labelIn="name"
                    valueIn="id"
                    childrenIn="children"
                    name="categories[]"
                    :masterValue="collect()"
                    :options="$Category->whereNull('parent_id')->latest()->get()"
                />
            </x-checkbox-group>
            
            <x-select 
                label="Статус:" 
                name="status_id" 
                :value="old('status_id')" 
                :options="$statuses->common()"
            />

        </x-form-nav-tab-content>
        {{-- end TAB 1 --}}

        {{-- TAB 2 --}}
        <x-form-nav-tab-content name="nav-2">
            @inject('PortfolioPostType', '\App\Models\PostType\PortfolioPostType')

            @foreach($meta_fields_groups as $meta_fields_group)
                @include('includes.meta-field', ['metaFields' => $meta_fields_group->fields, 'record' => null])
                @php
                    unset($metaFields);
                    unset($meta_fields_groups);
                @endphp
            @endforeach

        </x-form-nav-tab-content>
        {{-- end TAB 2 --}}

    </div>

@endsection

@section('scripts')
    
@endsection
