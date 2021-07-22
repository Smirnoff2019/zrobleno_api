@extends('layouts.edit')

@section('body-class', 'bg-light')

@section('container-class', 'container-fluid')

@section('card-header')
    <x-form-title><span class="text-dark">Тендер </span> <span class="">#{{ $record->uid }}</span> <span class="text-muted small">[{{ Breadcrumbs::currentTitle('', '') }}]</span></x-form-title>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
        
        <x-form-nav-tab name="nav-1" label="Основне" active="true" />

    </div>
@endsection

@section('form')
<div class="tab-content p-1" id="nav-tabContent">

    {{-- TAB 1 --}}
    <x-form-nav-tab-content name="nav-1" active="true" >

        {{-- Uid --}}
        <x-input 
            type="text" 
            label="Код тендеру:" 
            name="uid" 
            :value="'#'.(old('uid') ?? $record->uid)" 
            placeholder="#504379"
            disabled
        />

        {{-- Name --}}
        <x-input 
            type="text" 
            label="Назва:" 
            name="name" 
            :value="old('name') ?? $record->name" 
            placeholder="Введіть назву"
            required
        />

        {{-- Max Participants --}}
        <x-input 
            type="number" 
            label="Кількість місць на тендері:" 
            name="max_participants" 
            :value="old('max_participants') ?? $record->max_participants" 
            placeholder="2"
            min="2"
            max="99"
            required
        />

        {{-- Price --}}
        <div class="form-group">
            <label>Ціна за місце на тендері:</label>
            <div class="input-group mb-3">
                <input 
                    type="number" 
                    class="form-control" 
                    aria-describedby="price" 
                    name="price" 
                    value="{{ old('price') ?? $record->price }}"
                    placeholder="200" 
                    min="1"
                    required
                >   
                <div class="input-group-append">
                    <span class="input-group-text" id="price">грн.</span>
                </div>
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Started at --}}
        <x-input 
            type="date" 
            label="Дата початку:" 
            name="started_at" 
            :value="old('started_at') ?? $record->started_at->format('Y-m-d')" 
            required
        />

        {{-- Finished at --}}
        <x-input 
            type="date" 
            label="Дата завершення:" 
            name="finished_at" 
            :value="old('finished_at') ?? $record->finished_at->format('Y-m-d')" 
            required
        />

        {{-- Status --}}
        <x-select 
            label="Статус:" 
            name="status_id" 
            :value="old('status_id') ?? $record->status_id"
        >
            @foreach ($statuses as $status)
                <option 
                    value="{{ $status->id }}" 
                    @selected( (old('status_id') ?? $record->status_id ?? null) == $status->id )
                >{{ $status->name }}</option>
            @endforeach
        </x-select>
                
    </x-form-nav-tab-content>
    {{-- end TAB 1 --}}

</div>

@endsection

@section('scripts')
    
@endsection
