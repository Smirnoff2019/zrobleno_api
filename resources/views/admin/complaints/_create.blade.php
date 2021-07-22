@extends('layouts.create')

@section('container-class', 'container')

@section('card-header')
    <h3 class="mb-4">{{ $label ?? 'Оформити скаргу' }}</h3>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">

        <x-form-nav-tab
                name="nav-1"
                label="Основне"
                active="true">
        </x-form-nav-tab>

    </div>
@endsection

@section('form')

    @inject('statuses', 'App\Services\Blade\StatusesService')

    <div class="tab-content p-1" id="nav-tabContent">

        {{-- TAB 1 --}}
        <x-form-nav-tab-content name="nav-1" active="true" >

            <x-input
                    type="text"
                    label="Тема:"
                    name="subject"
                    :value="old('subject')"
                    placeholder="Додайте е...">
            </x-input>

            <x-input
                    type="text"
                    label="Повідомлення:"
                    name="message"
                    :value="old('message')"
                    placeholder="Введіть повідомлення...">
            </x-input>

            <x-select
                    label="Статус:"
                    name="status_id"
                    :value="old('status_id')"
                    :options="$statuses->complaint()">
            </x-select>

        </x-form-nav-tab-content>
        {{-- end TAB 1 --}}

    </div>

@endsection

@section('scripts')

@endsection
