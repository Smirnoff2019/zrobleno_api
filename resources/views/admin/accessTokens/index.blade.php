@extends('layouts.table-v2')

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

@endsection

@section('buttons')
    @if($routes->create)
        <div class="d-flex">
            <a href="{{ route($routes->create) }}" class="btn btn-sm btn-outline-primary text-nowrap px-3 mb-3">+ Створити</a>
        </div>
    @endif
@endsection

@section('thead')
    <th scope="row" class="border-right">#</th>
    <th scope="col">Посилання</th>
    <th scope="col">Код</th>
    <th scope="col">Статус</th>
    <th scope="col">Дата</th>
@endsection

@section('tbody')

    @forelse($records ?? [] as $index => $record)
    <tr>
        <th scope="row"  class="border-right">{{ $loop->iteration }}</th>

        <td class="text-nowrap">
            <a class="text-primary font-w-500" title="Перейти за посиланням" href="{{ $url = route('admin.contractors.sing-up.show', $record->token) }}">{{ $url }}</a>
        </td>

        <td class="text-nowrap">
            {{ $record->token }}
        </td>

        <td class="text-nowrap">
            @if((bool) $record->active == true) 
                <span class="font-w-500 text-nowrap text-success">Активна</span>
            @else
                <span class="font-w-500 text-nowrap text-secondary">Використана</span>
            @endif
        </td>

        <td>
            @isset($record->created_at)
                <span class="text-monospace text-nowrap"><i class="far fa-clock text-muted fs-2"></i> {{ $record->created_at->format('d.m.Y H:m') }}</span>
            @endisset
            @empty($record->created_at)
                <span class="text-muted-vp small">Not found</span>
            @endempty
        </td>
        
    </tr>
    @empty
        @section('after_table')
        <p class="text-center text-muted my-5">Not found...</p>
        @endsection
    @endforelse
@endsection

@section('scripts')
    
@endsection
