@extends('layouts.cards-list')

@section('filters')
        
    <div class="col-12 col-sm-4 col-md-3 col-lg-auto">
        <div class="form-group mb-3">
            <select class="form-control rounded-0" name="status_id" id="filter_status_id">
                <option value="">Статус</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" @selected($request->get('status_id', '') == $status->id)>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-12 col-sm-4 col-md-3 col-lg-auto">
        <div class="form-group mb-3">
            <select class="form-control rounded-0" name="sort_by" id="filter_sort">
                <option value="desc">Сортувати</option>
                <option value="{{ $sort_value = 'desc' }}" @selected($request->get('sort_by') == $sort_value)>Спочатку нові</option>
                <option value="{{ $sort_value = 'asc' }}" @selected($request->get('sort_by') == $sort_value)>Спочатку старі</option>
            </select>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-auto">
        <div class="ml-auto d-flex mb-3">
            <input type="number" name="uid" value="{{ $request->get('uid') }}" class="form-control mr-2" placeholder="#235697" aria-describedby="helpId">
            <div class="rounded-sm">
                <button class="rounded-sm btn btn-default font-w-500 px-3">Пошук</button>
            </div>
        </div>
    </div>

@endsection

@section('buttons')
    {{-- @if($routes->create)
        <div class="d-flex">
            <a href="{{ route($routes->create) }}" class="btn btn-sm btn-outline-primary text-nowrap px-3 mb-3">+ Створити тендер</a>
        </div>
    @endif --}}
@endsection

@section('cards')
    <div class="row mx-n2">
        @forelse($records ?? [] as $record)
            <div class="card mx-2 my-3 shadow border-silver" style="width: 23rem;">
                <div class="card-body flex-column justify-content-between d-flex">
                    <div class="">
                        <p class="fs-2 d-flex justify-content-between">
                            <span class="text-black font-w-500">№ {{ $record->uid }}</span>
                            <span>
                                <i class="far fa-clock text-muted" aria-hidden="true"></i>
                                {{ $record->created_at->format('d.m.Y H:m') }}
                            </span>
                        </p>
                        <h4 class="card-title mb-4"><a href="@if($record->tender->id ?? false) {{ route('admin.tenders.edit', $record->tender->id) }} @endif" title="Редагувати тендер">{{ $record->name }}</a></h4>
                        <p class="mb-4 d-flex">
                            @switch($record->status->type)
                                @case('awaiting_confirmation')
                                    <span class="bg-warning text-black font-w-500 rounded-pill px-3 py-1">{{ $record->status->name }}</span>
                                    @break
                                @case('on_designing')
                                    <span class="bg-secondary text-white font-w-500 rounded-pill px-3 py-1">{{ $record->status->name }}</span>
                                    @break
                                @case('confirmed')
                                    <span class="bg-success text-white font-w-500 rounded-pill px-3 py-1">{{ $record->status->name }}</span>
                                    @break
                                @case('canceled')
                                    <span class="bg-danger text-white font-w-500 rounded-pill px-3 py-1">{{ $record->status->name }}</span>
                                    @break
                                @case('awaiting_restart')
                                    <span class="bg-info text-white font-w-500 rounded-pill px-3 py-1">{{ $record->status->name }}</span>
                                    @break
                            
                                @default
                                    
                            @endswitch
                        </p>
                        <p class="card-text mb-2">Кіл-ть місць на тендері: <span class="ml-1 font-w-500">{{ $record->tender->max_participants }}</span></p>
                        <p class="card-text mb-2">Загальна площа: <span class="ml-1 font-w-500">{{ $record->tender->project->total_area }} м<sup>2</sup></span></p>
                        <p class="card-text mb-2">Загальна ціна: <span class="ml-1 font-w-500">@nformat($record->tender->project->total_price) грн.</span></p>
                        <p class="card-text mb-2">Замовник: <a href="@if($record->customer->id ?? false) {{ route('admin.users.edit', $record->customer->id) }} @endif" class="ml-1 font-w-500">{{ $record->customer->first_name ?? '' }} {{ $record->customer->last_name ?? '' }}</a></p>
                        <p class="card-text font-w-500 my-4"><a href="{{ route('admin.tenders.pdf', $record) }}">Відкрити ТЗ проекту</a></p>
                    </div>
                    <div class="d-flex mb-3">
                        <button type="submit" form="confirm_tender_application-{{ $loop->iteration }}" class="btn btn-primary btn-block" @if($record->status->type != 'awaiting_confirmation') disabled @endif>Підтвердити</button>
                        <div class="mx-1"></div>
                        <button type="submit" form="reject_tender_application-{{ $loop->iteration }}" class="btn btn-outline-secondary btn-block mt-0" @if($record->status->type != 'awaiting_confirmation') disabled @endif>Відхилити</button>
                        
                        <form id="confirm_tender_application-{{ $loop->iteration }}" action="{{ route($routes->confirm, $record) }}" class="d-none" method="POST"> @csrf </form>
                        <form id="reject_tender_application-{{ $loop->iteration }}" action="{{ route($routes->reject, $record) }}" class="d-none" method="POST"> @csrf </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

