@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-auto">
            <div class="list-group bg-light rounded border p-3 h-100">
                @forelse($records as $record)
                    @include('admin.calculator-settings.coefficient-per-region._card')
                @empty
                    @include('includes.empty')
                @endforelse
            </div>
        </div>
        <div class="col">
            <div class="sticky-top container-lg p-0 float-left" style="top: 5rem;">
                <form class="card shadow" 
                    action="{{ $update_url }}"
                    method="POST"
                >
                    <div class="card-header bg-transparent">
                        <h4 class="m-0">Редагувати коефіцієнт на область <span class="text-muted small"> [{{ Breadcrumbs::currentTitle() }}]</span></h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @inject('statuses', 'App\Services\Blade\StatusesService')

                        <x-input 
                            type="text"
                            label="Назва області:"
                            :value="old('name') ?? $current_record->name"
                            name="name"
                        />

                        {{-- <x-textarea 
                            label="Описание:"
                            :value="old('description') ?? $current_record->description"
                            name="description"
                            rows="8"
                        /> --}}
                        
                        <x-input 
                            type="text"
                            label="Ярлик:"
                            :value="old('slug') ?? $current_record->slug"
                            name="slug"
                            data-slugify="input#name"
                        />
                        
                        <x-input 
                            type="number"
                            label="Коефіцієнт:"
                            :value="old('value') ?? $current_record->value"
                            name="value"
                            placeholder="Вкажіть значення..."
                            min="0"
                            max="99"
                            step="0.001"
                        />
                        
                        <x-select 
                            label="Статус:" 
                            name="status_id" 
                            :value="old('status_id') ?? $current_record->status_id" 
                            :options="$statuses->common()"
                        />

                        <div class="my-5"></div>

                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center bg-transparent">
                        <span class="small text-muted"><i class="far fa-calendar-check mr-1"></i> {{ $current_record->created_at ?? 'Not found' }}</span>
                        <x-submit-btn/>
                    </div>
                </form>
            </div>
        </div>
    </div>    
@endsection
