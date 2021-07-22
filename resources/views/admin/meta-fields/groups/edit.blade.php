@extends('layouts.edit')

@section('container-class', 'container-fluid')

@section('card-header')
    <x-form-title>Редагувати групу мета-полів <span class="text-muted small"> [{{ Breadcrumbs::currentTitle() }}]</span></x-form-title>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
    
        <x-form-nav-tab
            name="nav-1"
            label="Основне"
            active="true"
        />
    
        <x-form-nav-tab
            name="nav-2"
            label="Мета-поля"
        />

    </div>
@endsection

@section('form')

    @inject('statuses', 'App\Services\Blade\StatusesService')

    <div class="tab-content p-1" id="nav-tabContent">
        {{-- TAB 1 --}}
        <x-form-nav-tab-content name="nav-1" active="true" >

            <x-input 
                type="text"
                label="Назва:"
                :value="old('name') ?? $record->name"
                name="name"
                placeholder="Створіть назву..."
            />

            <x-input 
                type="text"
                label="Ярлик:"
                :value="old('slug') ?? $record->slug"
                name="slug"
                placeholder="Створіть ярлик..."
                data-slugify="input#name"
            />
            
            <x-textarea 
                label="Опис:"
                :value="old('description') ?? $record->description"
                name="description"
                placeholder="Додайте опис..."
                rows="5"
            />

            @inject('postTypesModel', '\App\Models\PostType\PostType')
            <x-checkbox-group label="Розширити для (записів):">
                @foreach($postTypesModel->get() as $postType)
                    <li class="mb-1">
                        <input 
                            type="checkbox" 
                            class="custom-control-input" 
                            id="checkbox-postType-{{ $postType->slug }}"  
                            value="{{ $postType->id }}" 
                            name="accept_post_types[{{ $postType->slug }}]"
                            @checked((bool) $record->postTypes->find($postType->id))
                        >
                        <label 
                            class="custom-control-label" 
                            for="checkbox-postType-{{ $postType->slug }}" 
                            >{{ $postType->name }}
                        </label>
                    </li>
                @endforeach
            </x-checkbox-group>

            @inject('taxonomyModel', '\App\Models\Taxonomy\Taxonomy')
            <x-checkbox-group label="Розширити для (таксономій):">
                @foreach($taxonomyModel->get() as $taxonomy)
                    <li class="mb-1">
                        <input 
                            type="checkbox" 
                            class="custom-control-input" 
                            id="checkbox-taxonomy-{{ $taxonomy->slug }}"  
                            value="{{ $taxonomy->id }}" 
                            name="accept_taxonomies[{{ $taxonomy->slug }}]"
                            @checked((bool) $record->taxonomies->find($taxonomy->id))
                        >
                        <label 
                            class="custom-control-label" 
                            for="checkbox-taxonomy-{{ $taxonomy->slug }}" 
                            >{{ $taxonomy->name }}
                        </label>
                    </li>
                @endforeach
            </x-checkbox-group>

            <div class="mb-5"></div>

        </x-form-nav-tab-content>
        {{-- end TAB 1 --}}

        {{-- TAB 2 --}}
        <x-form-nav-tab-content name="nav-2">
            
            <div class="mb-5" id="meta-fields-schema">
                <ul class="list-group rounded-0 sortable">
                    
                    <x-meta.cards-list-header />
                    
                    @foreach($record->fields->whereNull('parent_id') as $metaField)
                        @include('includes.meta-field-card', [
                            'id'        => $metaField->id,
                            'name'      => $metaField->name,
                            'slug'      => $metaField->slug,
                            'type'      => $metaField->type,
                            'options'   => $metaField->options,
                            'parent_id' => $metaField->parent_id,
                            'children'  => $metaField->children ?? [],
                        ])
                    @endforeach
                    
                    <x-meta.cards-list-footer />

                </ul>
            </div>

            <div class="mb-5"></div>

        </x-form-nav-tab-content>
        {{-- end TAB 2 --}}

    </div>

@endsection
