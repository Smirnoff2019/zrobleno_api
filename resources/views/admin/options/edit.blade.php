@extends('layouts.edit')

@section('container-class', 'container')

@section('card-header')
    <x-form-title>Редагувати <span class="text-muted small"> [{{ Breadcrumbs::currentTitle() }}]</span></x-form-title>
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
                :value="old('name') ?? $record->name" 
                placeholder="Введіть назву"
                required
            />

            <x-input 
                type="text" 
                label="Ярлик:" 
                name="slug" 
                data-slugify="input#name"
                :value="old('slug') ?? $record->slug" 
                placeholder="Створіть ярлик"
                required
            />

            <x-textarea 
                label="Опис:" 
                name="description" 
                :value="old('description') ?? $record->description" 
                placeholder="Додайте опис..."
            />

            <x-select 
                label="Статус:" 
                name="status_id" 
                :value="old('status_id') ?? $record->status_id" 
                :options="$statuses->common()"
            />

            <x-input-image 
                label="Рендер:" 
                name="image_id" 
                :value="$record->image_id" 
                :url="$record->image->file->url ?? ''" 
                mode="single" 
            />

        </x-form-nav-tab-content>
        {{-- end TAB 1 --}}

        {{-- TAB 2 --}}
        <x-form-nav-tab-content name="nav-2">

            <x-select 
                label="Формула розрахунку ціни:" 
                name="formula_name" 
                :value="old('formula_name') ?? $record->formula_name" 
                :options="$calculator->сalculationFormulas"
            />
            
            <x-input 
                type="number" 
                label="Ціна:" 
                name="price" 
                :value="old('price') ?? $record->price" 
                placeholder="100"
                required
            />

            <x-input 
                type="number" 
                label="Кількість (за замовчуванням):" 
                name="quantity" 
                :value="old('quantity') ?? $record->quantity ?? 1" 
                placeholder="1"
                required
            />

            <x-input 
                type="number" 
                label="Коефіцієнт:" 
                name="coefficient" 
                :value="old('coefficient') ?? $record->coefficient ?? 1" 
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
                :value="old('room_id') ?? $record->room_id" 
                :options="$calculator->rooms()"
            />
                
            <x-select 
                label="Група:" 
                name="options_group_id" 
                :value="old('options_group_id') ?? $record->options_group_id" 
            >
                <x-select-option 
                    label="Без групи"
                    :value="null"
                    :selected="old('options_group_id') ?? $record->options_group_id == 0"
                />
                @foreach($groups->all()->groupBy('room_id') ?? [] as $room_id => $groups)
                    <optgroup label="{{ $room->find($room_id)->name ?? '' }}">
                        @foreach($groups as $group)
                            <x-select-option 
                                :label="$group->name"
                                :value="$group->id"
                                :selected="old('options_group_id') ?? $record->options_group_id == $group->id"
                            />
                        @endforeach
                    </optgroup>
                @endforeach
            </x-select>

            <x-input 
                type="number" 
                label="Позиція в группі:" 
                name="sort" 
                :value="old('sort') ?? $record->sort ?? 0" 
                placeholder="0"
                required
            />

            <p class="text-muted font-w-500 mb-3">Параметри взаємодії</p>
            
            <x-checkbox 
                label="Дозволити обирати користувачем" 
                name="display" 
                :checked="old('display') ?? $record->display" 
            />

            <x-checkbox 
                label="Обрано за замовчуванням" 
                name="default" 
                :checked="old('default') ?? $record->default" 
            />

            <p class="text-muted font-w-500 mb-3">Додаткові налаштування</p>

            <x-checkbox 
                label="Автоматичне визначення дверей для коридору" 
                name="middlewares[door]" 
                :checked="old('middlewares.door') ?? $record->middlewares['door'] ?? false" 
            />
        
        </x-form-nav-tab-content>
        {{-- end TAB 3 --}}

    </div>

@endsection

@section('scripts')
    
@endsection
