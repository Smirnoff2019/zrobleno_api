@extends('layouts.app')

@section('title', 'ЗРОБЛЕНО Admin')

@section('content')
    <form 
        class="card shadow mb-5" 
        action="{{ $action ?? '#' }}" 
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
