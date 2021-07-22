@extends('layouts.table')

@section('filters')

    @inject('calculator', 'App\Services\Blade\CalculatorService')
    <x-filters.choose 
        label="Комната"
        default="Выбрать..."
        name="room_id"
        :value="$request->get('room_id', '')"
        :options="$calculator->roomsByOptions()"
    />
    <x-filters.choose 
        label="Группа"
        default="Выбрать..."
        name="options_group_id"
        :value="$request->get('options_group_id', '')"
        :options="$calculator->optionsGroupByOptions()"
    />

@endsection

@section('thead')
    <th scope="col" class="bg-light">Обложка</th>
    <th scope="col">Название</th>
    <th scope="col">Ярлык</th>
    <th scope="col">Цена</th>
    <th scope="col">Комната</th>
    <th scope="col">Группа</th>
    <th scope="col">Позиция в группе</th>
    <th scope="col">Статус</th>
@endsection

@section('tbody')

    @forelse($records ?? [] as $index => $record)
    <tr>
        <th scope="row"  class="border-right">{{ $index+1}}</th>

        <x-table.column-type.image 
            :url="$record->image->file->url ?? ''"
        />

        <x-table.column-type.action 
            :id="$record->id"
            :label="$record->name"
            :editRoute="$routes->edit"
            :destroyRoute="$routes->destroy"
        />
        
        <x-table.column-type.text 
            :value="$record->slug ?? ''"
        />
        
        <x-table.column-type.text 
            :value="$record->price ?? ''"
        />
    
        <td>
            @if($record->room)
            <div class="btn-group dropright">
                <a href="#" target="_blank" class="relation-link dropdown-toggle" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                    {{ $record->room->name }} 
                </a>
                <div class="dropdown-menu fade">
                    <a class="dropdown-item text-primary bg-white" href="{{ route('admin.rooms.edit', ['room' => $record->room->id]) }}">Открыть</a>
                    <a class="dropdown-item text-primary bg-white" href="{{ route('admin.rooms.edit', ['room' => $record->room->id]) }}" target="blank">Открыть в новой вкладке</a>
                </div>
            </div>
            @else
            <span class="text-muted-vp small">Not found</span>
            @endif
        </td>

        <td>
            @if($record->optionsGroup)
            <div class="btn-group dropright">
                <a href="#" target="_blank" class="relation-link dropdown-toggle" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                    {{ $record->optionsGroup->name }} 
                </a>
                <div class="dropdown-menu fade">
                    <a class="dropdown-item text-primary bg-white" href="{{ route('admin.options-groups.edit', $record->optionsGroup->id) }}">Открыть</a>
                    <a class="dropdown-item text-primary bg-white" href="{{ route('admin.options-groups.edit', $record->optionsGroup->id) }}" target="blank">Открыть в новой вкладке</a>
                </div>
            </div>
            @else
            <span class="text-muted-vp small">Not found</span>
            @endif
        </td>
    
        <x-table.column-type.text 
            :value="$record->sort ?? ''"
        />

        <x-table.column-type.status 
            :status="$record->status ?? null"
        />
        
    </tr>
    @empty
        @section('after_table')
        <p class="text-center text-muted my-5">Not found...</p>
        @endsection
    @endforelse
@endsection

@section('scripts')
    
@endsection
