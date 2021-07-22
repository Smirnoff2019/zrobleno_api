@extends('layouts.login')

@push('script_midle')
 
@endpush

@section('content')
            
    <div class="row justify-content-center">
        <div class="col-lg-5 align-self-center">
            
            @if($authenticate_error ?? session('authenticate_error') ?? false)
                <x-alert type="danger" :message="$authenticate_error ?? session('authenticate_error')"/>
            @endif

            <div class="card shadow-lg rounded-lg mb-5">
                <div class="card-body">
                    
                    <h4 class="text-center font-weight-light mt-2 mb-4"><b>Админ панель</b></h4>
                    
                    <form action="{{ route('admin.authenticate') }}" method="POST">
                        @csrf

                        <x-input 
                            type="email" 
                            label="Логин:" 
                            name="email" 
                            :value="old('email')" 
                            placeholder="E-mail"
                            required/>

                        <x-input 
                            type="password" 
                            label="Пароль:" 
                            name="password" 
                            :value="old('password')" 
                            placeholder="Введите пароль"
                            required/>

                        <div class="form-group d-flex align-items-center justify-content-between mt-4 pt-1 pb-2 mb-4">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" name="remember_me" />
                                <label class="custom-control-label" for="rememberPasswordCheck">Запомнить меня</label>
                            </div>
                            <button class="btn btn-primary px-4">Войти</button>
                        </div>
                    </form>

                </div>
                
            </div>

        </div>
    </div>
        
@endsection

@section('scripts')
    
@endsection
