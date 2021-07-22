@extends('layouts.minimal')

@push('head')
<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }
    .code {
        border-right: 2px solid;
        font-size: 26px;
        padding: 0 15px 0 15px;
        text-align: center;
    }

    .message {
        font-size: 18px;
        text-align: center;
    }
</style>
@endpush

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center h-100">
        <div class="code">
            @yield('code')
        </div>

        <div class="message" style="padding: 10px;">
            @yield('message')
        </div>
    </div>
@endsection