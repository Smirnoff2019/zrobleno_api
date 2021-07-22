@extends('layouts.create')

@section('container-class', 'container')

@section('card-header')
    <x-form-title>{{ Breadcrumbs::currentTitle('', 'новую страницу') }}</x-form-title>
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
                placeholder="Введите заголовок..."
                required
                />

            <x-input 
                type="text" 
                label="Ярлык:" 
                name="slug" 
                :value="old('slug')" 
                placeholder="Введите ярлык..."
                data-slugify="input#title"
                required
                />

            <x-textarea 
                label="Описание:" 
                name="description" 
                :value="old('description')" 
                placeholder="Введите описание..."
                />
            
            <x-input-image 
                label="Изображение:" 
                name="image_id" 
                value="" 
                mode="single" 
                />
                
            <x-ckeditor 
                label="Контент:" 
                name="content" 
                placeholder="Введите контент..."
                rows="20"
                >
                {{ old('content') }}
            </x-ckeditor>

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
