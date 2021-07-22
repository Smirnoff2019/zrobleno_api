@extends('layouts.app')

@section('content')
    <div class="row mb-5">
        <div class="col-xl-auto col-12">
            <div class="list-group bg-light rounded border p-3 h-100">
                @each('includes.coefficient-nav-card', $records, 'record', 'includes.empty')
            </div>
        </div>
        <div class="col-xl col-12">
            <div class="sticky-top container-lg p-0 float-left" style="top: 5rem;">
                <form class="card shadow" 
                    action="{{ route($routes->store ?? '') }}"
                    method="POST"
                >
                    <div class="card-header bg-transparent">
                        <h4 class="m-0">{{ 'Створити коефіцієнт' }}</h4>
                    </div>
                    <div class="card-body">
                        @csrf

                        @inject('statuses', 'App\Services\Blade\StatusesService')

                        <x-input 
                            type="text"
                            label="Назва:"
                            :value="old('name')"
                            name="name"
                            placeholder="Створіть назву..."
                        />

                        <x-textarea 
                            label="Опис:"
                            :value="old('description')"
                            name="description"
                            placeholder="Додайте опис..."
                        />
                        
                        <x-input 
                            type="text"
                            label="Ярлик:"
                            :value="old('slug')"
                            name="slug"
                            placeholder="Створіть ярлик..."
                        />
                        
                        <x-input 
                            type="bumber"
                            label="Коефіцієнт:"
                            :value="old('value')"
                            name="value"
                            placeholder="Вкажіть значення..."
                        />
                        
                        <x-select 
                            label="Статус:" 
                            name="status_id" 
                            :value="old('status_id')" 
                            :options="$statuses->common()"
                        />

                        <div class="my-5"></div>

                    </div>
                    <div class="card-footer d-flex justify-content-between flex-row-reverse align-items-center bg-transparent">
                        <x-submit-btn label="Зберегти"/>
                    </div>
                </form>
            </div>
        </div>
    </div>    
@endsection

