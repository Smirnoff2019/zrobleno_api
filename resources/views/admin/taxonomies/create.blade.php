@extends('layouts.create')

@section('container-class', 'container')

@section('card-header')
    <x-form-title>{{ Breadcrumbs::currentTitle('', 'новая таксономия') }}</x-form-title>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
    
        <x-form-nav-tab name="nav-1" label="Основное" active="true" />

    </div>
@endsection

@section('form')

    @inject('statuses', 'App\Services\Blade\StatusesService')

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
                placeholder="Введите ярлык...">
            </x-input>

            <x-textarea 
                label="Описание:" 
                name="description" 
                :value="old('description')" 
                placeholder="Введите описание...">
            </x-textarea>
            
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
