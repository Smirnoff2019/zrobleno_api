@push('head')
    <!-- Styles -->
    <style>
        body {
            background-size: cover;
            background-position: center center;
            background-image: url({{ asset('images/bg-2.jpg') }});
            /* z-index: -1; */
        }
        body::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #00000075;
            z-index: -1;
        }
    </style>
@endpush

<!DOCTYPE html>
<html lang="@yield('lang', 'ru')">
    <head>
        @include('includes.head')
    </head>
    <body class="@yield('body_class')">

        <div class="container-fruid h-100 pb-5">
            <div class="d-flex justify-content-center align-items-center h-100 pb-5">

                <div class="container">
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
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" name="remember" />
                                                <label class="custom-control-label" for="rememberPasswordCheck">Запомнить меня</label>
                                            </div>
                                            <button class="btn btn-primary px-4">Войти</button>
                                        </div>
                                    </form>

                                </div>
                                
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        @stack('modals')

        @include('includes.foot')

    </body>
</html>
