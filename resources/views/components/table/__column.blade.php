
@switch($type)
    @case('action')
        <x-table.column-type.action 
            :id="$id"
            :value="$value"
            :edit="$edit"
            :delete="$delete"
            />
        @break
    @case('image')
        <x-table.column-type.image 
            :url="$value->file->url ?? ''"
            />
        {{-- <td>
            <img src="{{ asset('images/defaullt.jpg') }}" alt="">
        </td> --}}
        @break
    @case('string')
        <td>{{ $value }}</td>
        @break
        
    @default
        <td>{{ $value }}</td>
        
@endswitch