@extends('layouts.edit')

@section('container-class', 'container')

@section('card-header')
    <x-form-title>Редагувати <span class="text-muted small"> [{{ Breadcrumbs::currentTitle() }}]</span></x-form-title>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
    
        <x-form-nav-tab name="nav-1" label="Основне" active="true" />

    </div>
@endsection

@section('form')

    <div class="tab-content p-1" id="nav-tabContent">

        {{-- TAB 1 --}}
        <x-form-nav-tab-content name="nav-1" active="true" >
            <x-input-image 
                label="Аватар:" 
                name="image_id" 
                value="{{ $record->image->id ?? '' }}" 
                url="{{ $record->image->url ?? '' }}" 
                mode="single" 
                required
            />

            <x-input 
                type="text" 
                label="Назва:" 
                name="name" 
                value="{{ old('name') ?? $record->name }}" 
                placeholder="Введіть назву"
                required
            />

            <x-select 
                label="Колір:" 
                name="color" 
                value="{{ old('color') ?? $record->color }}" 
                required
            >
                <option value="" @selected(!old('color', null))>Обрати</option>
                @forelse($colors as $value => $label)
                    <option value="{{ $value ?? '' }}" @selected(old('color') ?? $record->color == $value)>{{ $label }}</option>
                @empty
                    <option value="" disable>Not found...</option>
                @endforelse
            </x-select>

            <x-select 
                label="Стать:" 
                name="gender" 
                value="{{ old('gender') ?? $record->gender }}" 
                required
            >
                <option value="" @selected(!old('gender', null)) disabled>Обрати</option>
                @forelse($genders as $value => $label)
                    <option value="{{ $value ?? '' }}" @selected(old('gender')?? $record->gender == $value)>{{ $label }}</option>
                @empty
                    <option value="" disabled>Not found...</option>
                @endforelse
            </x-select>

            <x-select 
                label="Група:" 
                name="group" 
                value="{{ old('group') ?? $record->group }}" 
                required
            >
                <option value="{{ $value = '' }}" disabled>Обрати</option>
                <option value="{{ $value = 'type-1' }}" @selected(old('group') ?? $record->group == $value)>Тип 1</option>
                <option value="{{ $value = 'type-2' }}" @selected(old('group') ?? $record->group == $value)>Тип 2</option>
                <option value="{{ $value = 'type-3' }}" @selected(old('group') ?? $record->group == $value)>Тип 3</option>
                <option value="{{ $value = 'type-4' }}" @selected(old('group') ?? $record->group == $value)>Тип 4</option>
                <option value="{{ $value = 'type-5' }}" @selected(old('group') ?? $record->group == $value)>Тип 5</option>
                <option value="{{ $value = 'type-6' }}" @selected(old('group') ?? $record->group == $value)>Тип 6</option>
                <option value="{{ $value = 'type-7' }}" @selected(old('group') ?? $record->group == $value)>Тип 7</option>
                <option value="{{ $value = 'type-8' }}" @selected(old('group') ?? $record->group == $value)>Тип 8</option>
            </x-select>
            <x-select 
                label="Статус:" 
                name="status_id" 
                value="{{ old('status_id') ?? $record->status_id }}" 
                required
            >
                <option value="" disabled>Обрати</option>
                @forelse ($statuses as $status)
                    <option value="{{ $status->id }}" @selected(old('status_id') == $status->id)>{{ $status->name }}</option>
                @empty
                    <option value="" disabled>Not found...</option>
                @endforelse
            </x-select>
            
        </x-form-nav-tab-content>
        {{-- end TAB 1 --}}

    </div>

@endsection

@section('scripts')
    
@endsection
