<tr>
    <th scope="row" class="tr-pagination border-right">{{ $loop->iteration ?? 0 }}</th>
    
    <x-table.column-type.image 
        :url="$record->image->url ?? ''"
    />
                    
    <x-table.column-type.action 
        :id="$record->id"
        :label="$record->name"
        :editRoute="$routes->edit"
        :destroyRoute="$routes->destroy"
        :level="$loop->depth ?? 0"
        width="500"
    />

    <x-table.column-type.text 
        :value="$record->slug ?? ''"
    />

    <x-table.column-type.text 
        :value="$record->description ?? ''"
    />

    <x-table.column-type.status 
        :status="$record->status ?? null"
    />
    
</tr>
@if($record->children && $level+=1)
    @foreach($record->children ?? [] as $index => $record)
        @include('admin.portfolios.categories.index-table-row', ['record' => $record, 'index' => $index, 'level' => $level])
    @endforeach
@endif