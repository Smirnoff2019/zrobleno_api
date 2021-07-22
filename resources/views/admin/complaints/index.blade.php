@extends('layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-xl-auto col-12">
        <div class="list-group bg-light rounded border p-3 h-100">
            @forelse($records as $record)
            @include('admin.complaints.card._card')
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
                    <h4 class="m-0">Відповісти на скаргу</h4>
                </div>
                <div class="card-body">
                    @csrf

                    {{-- @inject('statuses', 'App\Services\Blade\StatusesService') --}}

                    <x-input 
                        type="text"
                        label="Кому:"
                        value=""
                        name=""
                        placeholder=""
                        readonly
                    />
                    <x-input 
                        type="text"
                        label="Тема:"
                        value=""
                        name=""
                        placeholder=""
                        readonly
                    />

                    <x-textarea 
                        label="Жалоба:"
                        value=""
                        name=""
                        placeholder=""
                        readonly
                    />

                    <x-textarea 
                        label="Відповідь:"
                        value=""
                        name="answer"
                        placeholder="Введіть відповідь..."
                    />

                    <div class="my-5"></div>

                </div>
                <div class="card-footer d-flex justify-content-between flex-row-reverse align-items-center bg-transparent">
                    <x-submit-btn label="Відправити" disabled></x-submit-btn>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
