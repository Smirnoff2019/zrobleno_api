@extends('layouts.app')

@section('title', 'ЗРОБЛЕНО Admin')

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

@section('breadcrumb')
<x-breadcrumb 
    :list="$breadcrumb"
/>
@endsection

@section('content')
    
    <div class="card table-responsive shadow mb-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="m-0 p-0">{{ $title ?? 'Table' }}</h3>
        </div>
        <div class="card-body">
            {{-- Filters panel --}}
            <div class="row d-flex justify-content-between mb-3 ">
                
                <form action="#" method="get" class="col row">
                    <div class="input-group col">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Искать..." aria-label="Room..." aria-describedby="basic-addon2">
                    </div>
                    <div class="input-group col">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Сортировать</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </form>
                
                <div class="col">
                    <div class="d-flex flex-row-reverse">
                        @if($create && $create['allow'])
                        <a href="{{ route($create['route'] ?? '') }}" class="btn btn-outline-primary  px-3">+ Добавить</a>
                        @endif
                    </div>
                </div>
                
            </div>
            {{-- end Filters panel --}}
            {{-- Table --}}
            <div class="table-responsive">
                <table class="table gborder table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="row" class="border-right">#</th>
                            
                            @yield('thead')
                            
                        </tr>
                    </thead>
                    <tbody>
                    
                        @yield('tbody')
                    
                    </tbody>
                </table>

                <div class="d-flex justify-content-end">
                    {{ $records->links() }}
                </div>

            </div>
            {{-- end Table --}}
        </div>
    </div>
        
@endsection

@section('scripts')
    
@endsection
