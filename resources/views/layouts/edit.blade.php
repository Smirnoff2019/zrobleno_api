@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
    <form 
        class="card shadow border-silver mb-5" 
        action="{{ $action ?? $routes->update ? route($routes->update, $record->id) : '#' }}" 
        method="{{ $method ?? 'POST' }}">

        <nav class="card-header">
            @yield('card-header')
        </nav>

        <div class="card-body">
            
            @csrf
            @method($mv_method ?? 'PUT')

            @yield('form')

            <input type="hidden" name="id" value="{{ $record->id }}">

        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            <span class="small text-muted"><i class="far fa-calendar-check mr-1"></i> {{ $record->created_at ?? 'Not found' }}</span>
            <x-submit-btn/>
        </div>

    </form>
@endsection

@section('scripts')
    
@endsection
