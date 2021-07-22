@extends('layouts.edit')

@section('container-class', 'container')

@section('card-header')
    <h3 class="mb-4">{{ $label ?? 'Редактировать' }}</h3>
    <div class="nav nav-tabs *px-3 card-header-tabs" id="nav-tab" role="tablist">
    
        <x-form-nav-tab name="nav-1" label="Основное" active="true" />

        <a class="nav-item nav-link" 
            id="nav-2-tab" 
            data-toggle="tab" 
            href="#nav-2" 
            role="tab" 
            aria-controls="nav-2" 
            aria-selected="false"
            >Параметры калькулятора</a>

        <a class="nav-item nav-link" 
            id="nav-3-tab" 
            data-toggle="tab" 
            href="#nav-3" 
            role="tab" 
            aria-controls="nav-3" 
            aria-selected="false"
            >Параметры конструктора</a>

    </div>
@endsection

@section('form')

    @inject('statuses', 'App\Services\Blade\StatusesService')

    <div class="tab-content p-1 *mt-4" id="nav-tabContent">

        {{-- TAB 1 --}}
        <div class="tab-pane fade show active" 
            id="nav-1" 
            role="tabpanel" 
            aria-labelledby="nav-1-tab">

            <x-select 
                label="Статус:" 
                name="status_id" 
                :value="old('status_id')" 
                :options="$statuses->common()"/>

        </div>
        {{-- end TAB 1 --}}

        {{-- TAB 2 --}}
        <div class="tab-pane fade" 
            id="nav-2" 
            role="tabpanel" 
            aria-labelledby="nav-2-tab">


        </div>
        {{-- end TAB 2 --}}

        {{-- TAB 3 --}}
        <div class="tab-pane fade" 
            id="nav-3" 
            role="tabpanel" 
            aria-labelledby="nav-3-tab">

        </div>
        {{-- end TAB 3 --}}

    </div>

@endsection

@section('scripts')
    
@endsection
