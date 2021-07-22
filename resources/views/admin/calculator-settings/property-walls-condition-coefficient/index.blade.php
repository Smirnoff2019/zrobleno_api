@extends('layouts.app')

@section('content')
    <div class="row mb-5">
        <div class="col-xl-auto col-12">
            <div class="list-group bg-light rounded border p-3 h-100">
                @forelse($records as $record)
                    @include('admin.calculator-settings.property-condition-coefficient._card')
                @empty
                    <p style="min-width: 30rem" class="text-center">
                        @include('includes.empty')
                    </p>
                @endforelse
            </div>
        </div>
        <div class="col-xl col-12">
            <div class="sticky-top container-lg p-0 float-left" style="top: 5rem;">
                <form class="card shadow" 
                    action="{{ route($routes->store ?? '') }}"
                    method="POST"
                >
                    <div class="card-header bg-transparent">
                        <h4 class="m-0">{{ 'Додати коефіцієнт на стан стін' }}</h4>
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
                            rows="8"
                        />
                        
                        <x-input 
                            type="text"
                            label="Ярлик:"
                            :value="old('slug')"
                            name="slug"
                            placeholder="Створіть ярлик..."
                            data-slugify="input#name"
                        />
                        
                        <x-input 
                            type="number"
                            label="Коефіцієнт:"
                            :value="old('value')"
                            name="value"
                            placeholder="Вкажіть значення..."
                            min="0"
                            max="99"
                            step="0.001"
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

