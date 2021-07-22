@extends('layouts.edit')

@section('container-class', 'container')

@section('card-header')
    <x-form-title>Редактировать <span class="text-muted small"> [{{ Breadcrumbs::currentTitle() }}]</span></x-form-title>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
        
        <x-form-nav-tab name="nav-1" label="Основное" active="true" />

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
            :value="old('name') ?? $record->name" 
            placeholder="Название..."/>

        <x-input 
            type="text" 
            label="Ярлык:" 
            name="slug" 
            :value="old('slug') ?? $record->slug" 
            placeholder="slug"/>

        <x-input 
            type="number" 
            label="Позиция:" 
            name="sort" 
            :value="old('sort') ?? $record->sort" 
            placeholder="0"/>

        <x-input 
            type="number" 
            label="Максимальное количество:" 
            name="max_count" 
            :value="old('max_count') ?? $record->max_count" 
            placeholder="0"/>

        <x-input 
            type="number" 
            label="Количество по умолчанию:" 
            name="default_count" 
            :value="old('default_count') ?? $record->default_count" 
            placeholder="0"/>

            @inject('statuses', 'App\Services\Blade\StatusesService')
        <x-select 
            label="Статус:" 
            name="status_id" 
            :value="old('status_id') ?? $record->status_id" 
            :options="$statuses->common()"/>

        <x-input-image 
            label="Обложка:" 
            name="image_id" 
            :value="$record->image_id ?? ''" 
            :url="$record->image->file->url ?? ''" 
            mode="single" />
            
    </x-form-nav-tab-content>
    {{-- end TAB 1 --}}

</div>
@endsection

@section('scripts')
    
@endsection
