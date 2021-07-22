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
    .title {
        font-size: 36px;
        padding: 20px;
    }
</style>
@endpush

@section('content')
    <div class="align-items-center justify-content-center d-flex h-100">
        <div class="title">
            @yield('message')
        </div>
    </div>
@endsection