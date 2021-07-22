@extends('layouts.app')

@section('content')
    <div class="row mb-5">
        <div class="col-xl-auto col-12">
            <div class="list-group bg-light rounded border p-3 h-100">
                @forelse($records as $record)
                    @include('admin.widgets.card._card')
                @empty
                    @include('includes.empty')
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
                        <h4 class="m-0">{{ 'Створити віджет' }}</h4>
                    </div>
                    <div class="card-body">
                        @csrf

                        @inject('statuses', 'App\Services\Blade\StatusesService')

                        <x-input
                                type="text"
                                label="Назва:"
                                name="title"
{{--                                :value="old('title')"--}}
                                placeholder="Введіть назву...">
                        </x-input>

                        <x-input
                                type="text"
                                label="Ярлик:"
                                name="slug"
{{--                                :value="old('slug')"--}}
                                placeholder="Введіть ярлик...">
                        </x-input>

                        <x-textarea
                                label="Опис:"
                                name="description"
{{--                                :value="old('description')"--}}
                                placeholder="Додайте опис...">
                        </x-textarea>

                        <x-input-image
                                label="Логотип:"
                                name="image_id"
                                value=""
                                mode="single">
                        </x-input-image>

                        <x-select
                                label="Статус:"
                                name="status_id"
                                :value="old('status_id')"
                                :options="$statuses->common()">
                        </x-select>

                        <div class="my-5"></div>

                    </div>
                    <div class="card-footer d-flex justify-content-between flex-row-reverse align-items-center bg-transparent">
                        <x-submit-btn label="Зберегти"></x-submit-btn>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection