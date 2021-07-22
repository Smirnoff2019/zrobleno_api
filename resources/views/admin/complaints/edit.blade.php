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
                action="{{ route($routes->update, $current_record) }}"
                method="POST"
            >
                <div class="card-header bg-transparent">
                    <h4 class="m-0">Відповісти на скаргу</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')

                    {{-- @inject('statuses', 'App\Services\Blade\StatusesService') --}}

                    <input type="hidden" name="complaint_id" value="$current_record->id">

                    <x-input 
                        type="text"
                        label="Кому:"
                        name=""
                        :value="$current_record->user->full_name ?? ''"
                        placeholder=""
                        readonly
                    />
                    <x-input 
                        type="text"
                        label="Тема:"
                        name=""
                        :value="$current_record->subject ?? ''"
                        placeholder=""
                        readonly
                    />

                    <x-textarea 
                        label="Жалоба:"
                        name=""
                        :value="$current_record->message"
                        placeholder=""
                        readonly
                    />

                    <x-textarea 
                        label="Відповідь:"
                        :value="old('answer')"
                        name="answer"
                        placeholder="Введіть відповідь..."
                    />

                    <div class="my-5"></div>

                </div>
                <div class="card-footer d-flex justify-content-between flex-row-reverse align-items-center bg-transparent">
                    <x-submit-btn label="Відправити"/>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
