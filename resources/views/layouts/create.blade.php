@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
    <form 
        class="card shadow border-silver mb-5" 
        action="{{ $action ?? $routes->store ? route($routes->store) : '#' }}" 
        method="{{ $method ?? 'POST' }}">

        <nav class="card-header">
            @yield('card-header')
        </nav>

        <div class="card-body">
            
            @csrf

            @if($mv_method ?? false)
                @method($mv_method)
            @endif

            @yield('form')

        </div>

        <div class="card-footer">
            <x-submit-btn/>
        </div>

    </form>
@endsection

@section('scripts')
    
@endsection
