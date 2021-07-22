@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
    <div>
        @forelse ($records as $record)
            {{-- @dd($record) --}}
            <div class="alert shadow-sm border
                @if($record->read_at) border-silver @endif
                @switch($record->data['status'] ?? '')
                    @case('information')
                        alert-info @if(!$record->read_at) border-info @endif
                        @break
                    @case('error')
                        alert-error @if(!$record->read_at) border-error @endif
                        @break
                    @case('success')
                        alert-success @if(!$record->read_at) border-success @endif
                        @break
                
                    @default
                    border-silver
                @endswitch
            " role="alert">
                <h5 class="alert-heading mb-">{{ $record->data['title'] }}</h5>
                <p>{{ $record->data['content'] }}</p>
                @if(!$record->read_at)
                    <button role="submit" form="read-notification-{{ $record->id }}" class="btn btn-link p-0">Позначити як прочитано</button>
                @endif
                <form id="read-notification-{{ $record->id }}" class="d-none" method="POST" action="{{ route('admin.notifications.read', $record->id) }}">
                    @csrf
                </form>
            </div>
        @empty
            
        @endforelse    
        <div class="d-flex justify-content-end">
            {{ $records->links() }}
        </div>    
    </div>
@endsection

@section('scripts')
    
@endsection
