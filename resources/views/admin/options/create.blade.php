@extends('layouts.create')

@section('container-class', 'container')

@section('card-header')
    <x-form-title>{{ Breadcrumbs::currentTitle('', 'опцію') }}</x-form-title>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
    
        <x-form-nav-tab name="nav-1" label="Основне" active="true" />
        <x-form-nav-tab name="nav-2" label="Параметри калькулятора" />
        <x-form-nav-tab name="nav-3" label="Параметри конструктора" />

    </div>
@endsection

@section('form')

    @inject('calculator', 'App\Services\Blade\CalculatorService')
    @inject('statuses', 'App\Services\Blade\StatusesService')
    @inject('groups', 'App\Models\OptionsGroup\OptionsGroup')
    @inject('room', 'App\Models\Room\Room')

    <div class="tab-content p-1" id="nav-tabContent">

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

            <x-textarea 
                label="Опис:" 
                name="description" 
                :value="old('description')" 
                placeholder="Додайте опис..."
                required
            />

            <x-select 
                label="Статус:" 
                name="status_id" 
                :value="old('status_id')" 
                :options="$statuses->common()"
            />
            
            <x-input-image 
                label="Рендер:" 
                name="image_id" 
                value="" 
                mode="single" 
            />

        </x-form-nav-tab-content>
        {{-- end TAB 1 --}}

        {{-- TAB 2 --}}
        <x-form-nav-tab-content name="nav-2">

            <x-select 
                label="Формула розрахунку ціни:" 
                name="formula_name" 
                :value="old('formula_name')" 
                :options="$calculator->сalculationFormulas"
            />
            
            <x-input 
                type="number" 
                label="Ціна:" 
                name="price" 
                :value="old('price')" 
                placeholder="100"
                required
            />

            <x-input 
                type="number" 
                label="Кількість (за замовчуванням):" 
                name="quantity" 
                :value="old('quantity') ?? 1" 
                placeholder="1"
                required
            />

            <x-input 
                type="number" 
                label="Коефіцієнт:" 
                name="coefficient" 
                :value="old('coefficient') ?? 1" 
                placeholder="1"
                required
            />


        </x-form-nav-tab-content>
        {{-- end TAB 2 --}}

        {{-- TAB 3 --}}
        <x-form-nav-tab-content name="nav-3">

            <x-select 
                label="Кімната:" 
                name="room_id" 
                :value="old('room_id')" 
                :options="$calculator->rooms()"
            />

            <x-select 
                label="Група:" 
                name="options_group_id" 
                :value="old('options_group_id')" 
            >
                <x-select-option 
                    label="Без групи"
                    :value="null"
                    :selected="old('options_group_id') == 0"
                />
                @foreach($groups->all()->groupBy('room_id') ?? [] as $room_id => $groups)
                    <optgroup label="{{ $room->find($room_id)->name ?? '' }}">
                        @foreach($groups as $group)
                            <x-select-option 
                                :label="$group->name"
                                :value="$group->id"
                                :selected="old('options_group_id') == $group->id"
                            />
                        @endforeach
                    </optgroup>
                @endforeach
            </x-select>

            <x-input 
                type="number" 
                label="Позиція в группі:" 
                name="sort" 
                :value="old('sort') ?? 0" 
                placeholder="0"
                required
            />

            <p class="text-muted font-w-500 mb-3">Параметри взаємодії</p>
            
            <x-checkbox 
                label="Дозволити обирати користувачем" 
                name="display" 
                :checked="old('display')" 
            />

            <x-checkbox 
                label="Обрано за замовчуванням" 
                name="default" 
                :checked="old('default')" 
            />

            <p class="text-muted font-w-500 mb-3">Додаткові налаштування</p>

            <x-checkbox 
                label="Автоматичне визначення дверей для коридору" 
                name="middlewares[door]" 
                :checked="old('middlewares.door') ?? false" 
            />

        </x-form-nav-tab-content>
        {{-- end TAB 1 --}}

    </div>

@endsection

@section('scripts')
    
@endsection
