@extends('layouts.app')

@section('container-class', 'container-fluid')

@section('content')
    <div class="row">
        <div class="col-auto" style="width: 40rem;">
            <div class="card shadow">
                <img class="card-img-top" src="http://api.zrobleno.loc/images/defaullt.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Название карточки</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
        <div class="col">
            <form 
                class="card shadow mb-5" 
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
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection
