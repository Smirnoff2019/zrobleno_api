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
        tbody tr:hover 
        {
            cursor: pointer;
            background-color: #f9f9f9;
        }
        tr:hover .row-action 
        {
            opacity: 1;
        }
        .row-action .action-link,
        .row-action button
        {
            font-size: .8rem;
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
                <h4 class="mb-3 p-0 font-w-400">{{ Breadcrumbs::currentTitle() }}</h4>
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

        {{-- Cards list --}}
        <div class="mb-3">
            
            @yield('cards')

        </div>
        
        <div class="d-flex mb-5">
            {{ $records->links() }}
        </div>
        {{-- end Cards list --}}
        
@endsection

@section('scripts')
    
@endsection
