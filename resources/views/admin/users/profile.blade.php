@extends('layouts.portfolio')

@section('card-header')
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
    
        <x-form-nav-tab name="nav-1" label="Основное" active="true" />
        <x-form-nav-tab name="nav-2" label="Мета дані"/>

    </div>
@endsection

@section('form')

    @inject('statuses', 'App\Services\Blade\StatusesService')
    @inject('Category', 'App\Models\Category\Category')

    <div class="tab-content p-1" id="nav-tabContent">

        {{-- TAB 1 --}}
        <x-form-nav-tab-content name="nav-1" active="true" >

            <x-input 
                type="text" 
                label="Название:" 
                name="title" 
                :value="old('title') ?? $record->title" 
                placeholder="Название..."
            />

            <x-input 
                type="text" 
                label="Ярлык:" 
                name="slug" 
                :value="old('slug') ?? $record->slug" 
                placeholder="slug"
                data-slugify="input#title"
            />

            <x-textarea 
                label="Описание:" 
                name="description" 
                :value="old('description') ?? $record->description" 
                placeholder="Введите описание..."
            />
                
            {{-- <x-ckeditor 
                label="Контент:" 
                name="content" 
                placeholder="Введите контент..."
                rows="15"
            >
                {{ old('content') ?? $record->content }}
            </x-ckeditor> --}}

            <x-input-image 
                label="Изображение:" 
                name="image_id" 
                :value="$record->image_id" 
                :url="$record->image->file->url ?? ''" 
                mode="single" 
            />
            
            @inject('Category', 'App\Models\Category\PortfolioCategory')
            <x-checkbox-group label="Категории:">
                <x-checkbox-group-children 
                    labelIn="name"
                    valueIn="id"
                    childrenIn="children"
                    name="categories[]"
                    :masterValue="$record->categories"
                    :options="$Category->whereNull('parent_id')->latest()->get()"
                />
            </x-checkbox-group>
            
            <x-select 
                label="Статус:" 
                name="status_id" 
                :value="old('status_id') ?? $record->status_id" 
                :options="$statuses->common()"
            />

        </x-form-nav-tab-content>
        {{-- end TAB 1 --}}

        {{-- TAB 2 --}}
        <x-form-nav-tab-content name="nav-2">

            @foreach($record->metaFieldsSchema()->with(['fields' => function($query) {
                return $query->whereNull('parent_id');
            }])->get() as $metaFieldsGroup)
                @include('includes.meta-field', ['metaFields' => $metaFieldsGroup->fields, 'record' => $record])
                @php
                    unset($metaFields);
                    unset($metaFieldsGroup);
                @endphp
            @endforeach

        </x-form-nav-tab-content>
        {{-- end TAB 2 --}}
    
    </div>
@endsection

@section('scripts')
    
@endsection
