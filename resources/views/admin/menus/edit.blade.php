@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-auto">
            <div class="list-group bg-light rounded border p-3 h-100">
                @forelse($records as $record)
                    @include('admin.menus.card._card')
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
                        <h4 class="m-0">Редагувати
                            <span class="text-muted small"> [{{ Breadcrumbs::currentTitle() }}]</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @inject('statuses', 'App\Services\Blade\StatusesService')

                        <x-input
                                type="text"
                                label="Назва:"
                                name="title"
                                :value="old('title') ?? $current_record->title">
                        </x-input>

                        <x-input
                                type="text"
                                label="Ярлик:"
                                name="slug"
                                :value="old('slug') ?? $current_record->slug">
                        </x-input>

                        <x-textarea
                                label="Опис:"
                                name="description"
                                :value="old('description') ?? $current_record->description"
                                rows="8">
                        </x-textarea>

                        <x-input-image
                                label="Логотип:"
                                name="image_id"
                                :value="$record->image_id"
                                :url="$record->image->file->url ?? ''"
                                mode="single">
                        </x-input-image>

                        <x-select
                                label="Статус:"
                                name="status_id"
                                :value="old('status_id') ?? $current_record->status_id"
                                :options="$statuses->common()">
                        </x-select>

                        <div class="my-5"></div>

                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center bg-transparent">
                        <span class="small text-muted">
                            <i class="far fa-calendar-check mr-1"></i> {{ $current_record->created_at ?? 'Not found' }}
                        </span>
                        <x-submit-btn></x-submit-btn>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
