@extends('layouts.app')

@section('title', 'ЗРОБЛЕНО Admin')

@section('content')
            
    <h1 class="mt-4">@yield('page_title', 'Зроблено Admin' )</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Cards</li>
    </ol>
    <div class="row">
        @for($i = 0; $i < 10; $i++)
        <div class="col-xl-3 col-md-6">
            <div class="card mb-4 shadow">
                <div class="card-header bg-primary text-white">
                    Primary Card
                </div>
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam magnam similique, nemo numquam veniam veritatis natus labore voluptatum voluptates explicabo nesciunt esse officiis expedita ratione quod itaque nihil cumque quisquam!
                </div>
            </div>
        </div>
        @endfor
    </div>
        
@endsection

@section('scripts')
    
@endsection
