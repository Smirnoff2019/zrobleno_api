@extends('layouts.create')

@section('container-class', 'container')

@section('card-header')
    <x-form-title>{{ Breadcrumbs::currentTitle('', 'групу опцій') }}</x-form-title>
    <div class="nav nav-tabs *px-3 card-header-tabs" id="nav-tab" role="tablist">
    
        <x-form-nav-tab name="nav-1" label="Основне" active="true" />

    </div>
@endsection

@section('form')

    @inject('calculator', 'App\Services\Blade\CalculatorService')
    @inject('statuses', 'App\Services\Blade\StatusesService')

    <div class="tab-content p-1 *mt-4" id="nav-tabContent">

        {{-- TAB 1 --}}
        <x-form-nav-tab-content name="nav-1" active="true" >

            <x-input 
                type="text" 
                label="Назва:" 
                name="name" 
                :value="old('name')" 
                placeholder="Введіть назву"
                required
            />

            <x-input 
                type="text" 
                label="Ярлик:" 
                name="slug" 
                data-slugify="input#name"
                :value="old('slug')" 
                placeholder="Створіть ярлик"
                required
            />

            <x-input 
                type="number" 
                label="Позиція в списку:" 
                name="sort" 
                :value="old('sort') ?? 0" 
                placeholder="0"
                required
            />
                
            <div class="form-group">

                <label for="{{ $name = 'position' }}">Положення на екрані</label>
                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="position_y">Top</span>
                    </div>
                    <input 
                        type="number" 
                        class="form-control" 
                        placeholder="10" 
                        aria-label="10%" 
                        aria-describedby="position_y" 
                        name="position_y" 
                        value="{{ old('position_y') ?? 10 }}"
                        required
                    >
                    <div class="input-group-append">
                        <span class="input-group-text" id="position_y">%</span>
                    </div>
                    @error('position_y')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="position_x">Left</span>
                    </div>
                    <input 
                        type="number" 
                        class="form-control" 
                        placeholder="10" 
                        aria-label="10%" 
                        aria-describedby="position_x" 
                        name="position_x" 
                        value="{{ old('position_x') ?? 10 }}"
                        required
                    >
                    <div class="input-group-append">
                        <span class="input-group-text" id="position_x">%</span>
                    </div>
                    @error('position_x')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <x-select 
                label="Кімната:" 
                name="room_id" 
                :value="old('room_id')" 
                :options="$calculator->rooms()"
            />

            <x-input-image 
                label="Рендер (підкладка):" 
                name="image_id" 
                value="" 
                mode="single" 
            />

            
            <x-select 
                label="Статус:" 
                name="status_id" 
                :value="old('status_id')" 
                :options="$statuses->common()"
            />

            <p class="text-muted font-w-500 mb-3">Параметри взаємодії</p>
            
            <x-checkbox 
                label="Відображати на екрані для вибору користувачем" 
                name="display" 
                :checked="old('display')" 
            />

        </x-form-nav-tab-content>
        {{-- end TAB 1 --}}

    </div>

@endsection

@section('scripts')
    
@endsection
