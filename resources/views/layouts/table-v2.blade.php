@extends('layouts.app')

@section('body-class', 'bg-silver')

@push('head')
    <!-- Styles -->
    <style>
        tr > th:first-child 
        {
            width: 50px;
            text-align: center;
        }
        .row-action 
        {
            opacity: 0;
        }
        tbody tr:first-child:hover
        {
            box-shadow: inset 0px -1px 0px 0px #dee2e6;
        }
        tbody tr:last-child:hover
        {
            box-shadow: inset 0px 1px 0px 0px #dee2e6;
        }
        tbody tr:hover 
        { 
            cursor: pointer;
            box-shadow: inset 0px 1px 0px 0px #dee2e6, inset 0px -1px 0px 0px #dee2e6;
        }
        tr:hover .row-action 
        {
            opacity: 1;
        }
        .row-action .action-link,
        .row-action button
        {
            outline: none;
        }
        .row-action .action-link:hover,
        .row-action button:hover {
            text-decoration: underline;
        }
        .row-action .text-danger.action-link:hover,
        .row-action button.text-danger:hover
        {
            color: #b12835 !important;
        }
    </style>
@endpush

@section('content')
        
    {{-- Header panel --}}
    <div class="row">
        <div class="col-12 col-sm align-items-center">
            <h4 class="mb-3 p-0 font-w-400">{{ Breadcrumbs::currentTitle() }} @stack('header-title') </h4>
        </div>
        
        <div class="col-12 col-sm-auto">
            @yield('buttons')
        </div>

        <div class="col-12">
            <form id="filters-form" action="{{ url()->current() }}" method="get" class="my-1">
                <div class="row filters-bar">

                    @yield('filters')

                </div>
            </form>
        </div>
        
    </div>
    {{-- end Header panel --}}

    {{-- Table --}}
    <div class="table-responsive mb-3">
        
        @yield('before_table')

        <table class="table table-striped border border-silver table-borderless table-responsive-lg bg-white">
            <thead class="border-bottom border-silver @yield('thead_class')">
                <tr>
                    @yield('thead')
                </tr>
            </thead>
            <tbody class="@yield('tbody_class')">
            
                @yield('tbody')
            
            </tbody>
        </table>

        @yield('after_table')

    </div>
    
    <div class="d-flex justify-content-between px-2 mb-5">
        <span class="fs-2 text-muted">Всього: {{ $records->total() }} записів</span>
        {{ $records->withQueryString()->links() }}
    </div>
    {{-- end Table --}}
        
@endsection

@section('scripts')
    
@endsection
