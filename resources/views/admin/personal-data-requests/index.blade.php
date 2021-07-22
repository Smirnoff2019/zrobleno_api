@extends('layouts.cards-list')

@section('filters')

    @include('includes.filters.perPage')

    @include('includes.filters.status')

    @include('includes.filters.sortBy', ['keys' => [
        'latest' => 'Спочатку нові',
        'oldest' => 'Спочатку старі',
    ]])

    @include('includes.filters.search', ['name' => 'name'])

@endsection

@section('cards')
    <div class="row mx-n2">
        @forelse($records ?? [] as $record)
            <div class="card mx-2 my-3 shadow border-silver" style="width: 23rem;">
                <div class="card-body flex-column justify-content-between d-flex">
                    <div class="">
                        <p class="fs-2 d-flex justify-content-between">
                            <span class="text-black font-w-500">№{{ Str::padLeft($record->id, 6, 0) }}</span>
                            <span>
                                <i class="far fa-clock text-muted" aria-hidden="true"></i>
                                {{ $record->created_at->format('d.m.Y H:m') }}
                            </span>
                        </p>
                        <h4 class="card-title mb-4">
                            @isset($record->user)
                                <a href="@if($record->id ?? false) {{ route('admin.users.personal-data-requests.edit', $record->id) }} @endif" title="Редагувати данні">{{ $record->user->full_name }}</a>
                            @endisset
                        </h4>
                        <p class="mb-4 d-flex">
                            @if($record->status)
                                @switch($record->status->type ?? '')
                                    @case('awaiting_confirmation')
                                        <span class="bg-warning text-black font-w-500 rounded-pill border border-warning px-3 py-1">{{ $record->status->name }}</span>
                                        @break
                                    @case('on_designing')
                                        <span class="bg-secondary text-white font-w-500 rounded-pill border border-secondary px-3 py-1">{{ $record->status->name }}</span>
                                        @break
                                    @case('confirmed')
                                        <span class="bg-success text-white font-w-500 rounded-pill border border-success px-3 py-1">{{ $record->status->name }}</span>
                                        @break
                                    @case('canceled')
                                        <span class="bg-danger text-white font-w-500 rounded-pill border border-danger px-3 py-1">{{ $record->status->name }}</span>
                                        @break
                                    @case('awaiting_restart')
                                        <span class="bg-info text-white font-w-500 rounded-pill border border-info px-3 py-1">{{ $record->status->name }}</span>
                                        @break
                                
                                    @default
                                        
                                @endswitch
                            @endisset
                        </p>
                        {{-- <p class="card-text mb-2">Підрядник: <a href="@if($record->user->id ?? false) {{ route('admin.users.edit', $record->user->id) }} @endif" class="ml-1 font-w-500">{{ $record->user->first_name ?? '' }} {{ $record->user->last_name ?? '' }}</a></p> --}}
                        <p class="py-4">
                            <a href="{{ route($routes->edit, $record) }}" class="card-link font-w-500 fs-4">Переглянути</a>
                        </p>
                    </div>
                    <div class="d-flex mb-3">
                        <button type="submit" form="confirm_user_personal_data_request-{{ $loop->iteration }}" class="btn btn-primary btn-block" @if($record->status->type != 'awaiting_confirmation') disabled @endif>Підтвердити</button>
                        <div class="mx-1"></div>
                        <button type="submit" form="reject_user_personal_data_request-{{ $loop->iteration }}" class="btn btn-outline-secondary btn-block mt-0" @if($record->status->type != 'awaiting_confirmation') disabled @endif>Відхилити</button>

                        <form id="confirm_user_personal_data_request-{{ $loop->iteration }}" action="{{ route($routes->confirm, $record) }}" class="d-none" method="POST"> @csrf </form>
                        <form id="reject_user_personal_data_request-{{ $loop->iteration }}" action="{{ route($routes->reject, $record) }}" class="d-none" method="POST"> @csrf </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

