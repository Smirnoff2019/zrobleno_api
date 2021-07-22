@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
    <form 
        class="row" 
        action="{{ $action ?? $routes->update ? route($routes->update, $record->id) : '#' }}" 
        method="{{ $method ?? 'POST' }}"
    >
        @csrf
        @method($mv_method ?? 'PUT')

        <input type="hidden" name="id" value="{{ $record->id }}">

        <nav class="col-12">
            @yield('nav')
        </nav>

        @yield('form')

        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <x-submit-btn/>
                <span class="mx-1 small text-muted"><i class="far fa-calendar-check mr-1"></i> {{ $record->created_at ?? 'Not found' }}</span>
            </div>
        </div>

    </form>
    
@endsection

@section('scripts')
    
@endsection
