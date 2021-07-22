@props(['records' => []])
@forelse($records as $record)
    {{ $slot }}
    @if($record->children ?? null)
        <x-table.depth-iterator :records="$record->children" :parent="$record" >
            {{ $slot }}
        </x-table.depth-iterator>
    @endif
@empty
    @once('after_table')
    <p class="text-center text-muted my-5">Not found...</p>
    @endonce
@endforelse