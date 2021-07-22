@extends('layouts.edit')

@section('container-class', 'container')

@section('card-header')
    <x-form-title>Редактировать изображение <span class="text-muted small"> [{{ Breadcrumbs::currentTitle() }}]</x-form-title>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
        
        <x-form-nav-tab name="nav-1" label="Файл" active="true" />
        <x-form-nav-tab name="nav-2" label="Изображение" />

    </div>
@endsection

@section('form')
<div class="tab-content p-1" id="nav-tabContent">

    {{-- TAB 1 --}}
    <div class="tab-pane fade show active" 
        id="nav-1" 
        role="tabpanel" 
        aria-labelledby="nav-1-tab">

        <div class="d-flex mb-3 page-image-thumbnail mx-n4 mt-n4 border">
            <img src="{{ $record->file->url ?? '#' }}" alt="" class="w-100" >
        </div>
    
    
        <x-input 
            type="text" 
            label="Заголовок:" 
            name="title" 
            :value="old('title') ?? $record->file->title" 
            placeholder="Название..."/>

        <x-textarea 
            label="Описание:" 
            name="description" 
            :value="old('description') ?? $record->file->description" 
            placeholder=""/>

        <div class="form-group">
            <label for="image-url-inp">Ссылка:</label>
            <div class="input-group mb-3">
                <input 
                    id="image-url-inp"
                    type="text" 
                    class="form-control" 
                    value="{{ env('APP_URL') . (old('url') ?? $record->file->url) }}" 
                    placeholder="{{ env('APP_URL') }}" 
                    disabled
                >
                <div class="input-group-append">
                    <a href="{{ env('APP_URL') . (old('url') ?? $record->file->url) }}" class="btn btn-outline-secondary" target="_blank" title="Открыть в новой вкладке">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </div>
        </div>

        <x-input 
            disabled
            type="text" 
            label="Название:" 
            name="" 
            :value="old('name') ?? $record->file->name" 
            placeholder="Название..."/>

        <x-input 
            disabled
            type="text" 
            label="Рассположение:" 
            name="" 
            :value="old('path') ?? $record->file->path" 
            placeholder="..."/>

        @inject('statuses', 'App\Services\Blade\StatusesService')
        <x-select 
            label="Статус:" 
            name="status_id" 
            :value="old('status_id') ?? $record->file->status_id" 
            :options="$statuses->common()"/>

    </div>
    {{-- end TAB 1 --}}
    
    {{-- TAB 2 --}}
    <div class="tab-pane fade show active" 
        id="nav-2" 
        role="tabpanel" 
        aria-labelledby="nav-2-tab">
    </div>
    {{-- end TAB 2 --}}

</div>
@endsection

@section('scripts')
    
@endsection
