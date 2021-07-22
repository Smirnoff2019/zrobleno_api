@extends('layouts.app')

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

@section('content')
    <div class="card table-responsive shadow mb-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="m-0 p-0">{{ Breadcrumbs::currentTitle() }}</h4>
        </div>
        <div class="card-body">
            {{-- Filters panel --}}
            <div class="row d-flex justify-content-between ">
                
                <form id="filters-form" action="{{ url()->current() }}" method="get" class="col-12 col-xl mb-1">
                    <div class="row">
                        <x-filters.search 
                            :value="$request->get('search', '')"
                        />

                        <x-filters.choose 
                            label="Сортировать"
                            default="Выбрать..."
                            name="sort_by"
                            :value="$request->get('sort_by', '')"
                            :options="$filters['sort_by'] ?? []"
                        />

                        @yield('filters')
                    </div>
                </form>
                
                <div class="col-12 col-xl-2">
                    <div class="d-flex flex-row-reverse">
                        @if($routes->create)
                        <a href="{{ route($routes->create) }}" class="btn btn-outline-primary text-nowrap px-3 mb-3">+ Добавить</a>
                        @endif
                    </div>
                </div>
                
            </div>
            {{-- end Filters panel --}}

            {{-- Table --}}
            <div class="table-responsive">
                
                @yield('before_table')

                <table class="table gborder table-hover table-bordered">
                    <thead class="@yield('thead_class')">
                        <tr>
                            <th scope="row" class="border-right">#</th>
                            
                            @yield('thead')
                            
                        </tr>
                    </thead>
                    <tbody>
                    
                        @yield('tbody')
                    
                    </tbody>
                </table>

                @yield('after_table')

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
