@extends('layouts.edit')

@section('container-class', 'container')

@section('card-header')
    <x-form-title>Переглянути <span class="text-muted small"> [{{ Breadcrumbs::currentTitle() }}]</span></x-form-title>
    <div class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">

        <x-form-nav-tab
                name="nav-1"
                label="Основне"
                active="true">
        </x-form-nav-tab>

    </div>
@endsection

@section('form')

    <div class="tab-content p-1" id="nav-tabContent">

        {{-- TAB 1 --}}
        <x-form-nav-tab-content name="nav-1" active="true" >

            <div class="table-responsive mb-3">

                <table class="table table-borderless border table-responsive-lg bg-white">
                    <thead class="thead-light">
                    <tr>
                        <th>Назва</th>
                        <th>Current data</th>
                        <th>Request data</th>
                    </tr>
                    </thead>
                    <tbody class="">

                    <tr>
                        <td class="font-w-500 text-muted">Ім'я</td>
                        <td class="text-body">{{ $record->user->first_name }}</td>
                        <td class="text-danger">{{ $data->first_name }}</td>
                    </tr>
                    <tr>
                        <td class="font-w-500 text-muted">Прізвище</td>
                        <td class="text-body">{{ $record->user->last_name }}</td>
                        <td class="text-danger">{{ $data->last_name }}</td>
                    </tr>
                    <tr>
                        <td class="font-w-500 text-muted">Побатькові</td>
                        <td class="text-body">{{ $record->user->middle_name }}</td>
                        <td class="text-danger">{{ $data->middle_name }}</td>
                    </tr>
                    <tr>
                        <td class="font-w-500 text-muted">Контактний телефон</td>
                        <td class="text-body">{{ $record->user->phone }}</td>
                        <td class="text-danger">{{ $data->phone }}</td>
                    </tr>
                    <tr>
                        <td class="font-w-500 text-muted">E-mail</td>
                        <td class="text-body">{{ $record->user->email }}</td>
                        <td class="text-danger">{{ $data->email }}</td>
                    </tr>
                    <tr>
                        <td class="font-w-500 text-muted">bill</td>
                        <td class="text-body">{{ $legal->bill ?? '' }}</td>
                        <td class="text-danger">{{ $legal_request->bill ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-w-500 text-muted">МФО</td>
                        <td class="text-body">{{ $legal->MFO ?? '' }}</td>
                        <td class="text-danger">{{ $legal_request->MFO ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-w-500 text-muted">EDRPOU</td>
                        <td class="text-body">{{ $legal->EDRPOU_code ?? '' }}</td>
                        <td class="text-danger">{{ $legal_request->EDRPOU_code ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-w-500 text-muted">Серія та номер паспорту</td>
                        <td class="text-body">{{ $legal->serial_number ?? '' }}</td>
                        <td class="text-danger">{{ $legal_request->serial_number ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-w-500 text-muted">Юридичний статус</td>
                        <td class="text-body">{{ $legal->legal_status ?? '' }}</td>
                        <td class="text-danger">{{ $legal_request->legal_status ?? '' }}</td>
                    </tr>

                    </tbody>
                </table>

            </div>

        </x-form-nav-tab-content>
        {{-- end TAB 1 --}}

    </div>

@endsection
