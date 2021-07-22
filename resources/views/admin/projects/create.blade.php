@extends('layouts.create')

@section('body-class', 'bg-light')

@section('container-class', 'container-fluid')

@section('card-header')
    <x-form-title>{{ Breadcrumbs::currentTitle('', 'проект ремонту') }}</x-form-title>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
        
        <x-form-nav-tab name="nav-1" label="Основне" active="true" />
        
    </div>
@endsection

@section('form')

<div class="tab-content p-1" id="nav-tabContent">

    {{-- TAB 1 --}}
    <x-form-nav-tab-content name="nav-1" active="true" >

        {{-- Стан стін --}}
        <x-select 
            class="text-black"
            label="Стан стін" 
            name="walls_condition_id" 
            :value="old('walls_condition_id') ?? $walls_condition_id ?? null" 
        >
            @foreach ($walls_conditions as $walls_condition)
                <option value="{{ $walls_condition->id }}" @selected(old('walls_condition_id', $walls_condition_id) == $walls_condition->id)>{{ $walls_condition->name }}</option>
            @endforeach
        </x-select>

        {{-- Область --}}
        <x-select 
            class="text-black"
            label="Область" 
            name="region_id" 
            :value="old('region_id') ?? $region_id" 
        >
            @foreach ($regions as $region)
                <option value="{{ $region->id }}" @selected(old('region_id', $region_id) == $region->id)>{{ $region->name }}</option>
            @endforeach
        </x-select>

        {{-- Місто --}}
        <x-input 
            type="text" 
            label="Місто:" 
            name="city" 
            :value="old('city', $city ?? '')" 
            placeholder="Киї..."/>

        {{-- Адреса --}}
        <x-input 
            type="text" 
            label="Адреса:" 
            name="address" 
            :value="old('address') ?? $address" 
            placeholder="Введіть адресу"
        />

        {{-- Стан об’єкту --}}
        <x-select 
            class="text-black"
            label="Стан об’єкту" 
            name="property_condition_id" 
            :value="old('property_condition_id') ?? $property_condition_id ?? null" 
        >
            @foreach ($property_conditions as $property_condition)
                <option value="{{ $property_condition->id }}" @selected(old('property_condition_id', $property_condition_id ?? null) == $property_condition->id)>{{ $property_condition->name }}</option>
            @endforeach
        </x-select>

        {{-- Висота стелі --}}
        <x-select 
            class="text-black"
            label="Висота стелі" 
            name="ceiling_height_id" 
            :value="old('ceiling_height_id') ?? $ceiling_height_id" 
        >
            @foreach ($ceiling_heights as $ceiling_height)
                <option value="{{ $ceiling_height->id }}" @selected(old('ceiling_height_id', $ceiling_height_id ?? null) == $ceiling_height->id)>{{ $ceiling_height->name }}</option>
            @endforeach
        </x-select>

        <x-input 
            type="text" 
            label="Загальна площа <span class='text-muted fs-2'>(м2)</span>:" 
            name="total_area" 
            :value="old('total_area') ?? $total_area ?? 0" 
            placeholder="0"
            readonly
        />

        <x-input 
            type="text" 
            label="Загальна ціна робіт <span class='text-muted fs-2'>(грн)</span>:" 
            name="total_price" 
            :value="old('total_price') ?? $total_price ?? 0" 
            placeholder="0"
            readonly
        />

        @inject('statuses', 'App\Services\Blade\StatusesService')
        <x-select 
            label="Статус:" 
            name="status_id" 
            :value="old('status_id') ?? $status_id ?? 0" 
            :options="$statuses->common()"
        />

        <x-textarea 
            label="Options" 
            name="components" 
            placeholder="[]"
            rows="8"
        >@json($components)</x-textarea>
                
    </x-form-nav-tab-content>
    {{-- end TAB 1 --}}

</div>
@endsection

@section('scripts')
    
@endsection
