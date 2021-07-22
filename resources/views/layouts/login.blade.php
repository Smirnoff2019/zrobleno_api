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

                    @yield('content')

                </div>

            </div>
        </div>

        @stack('modals')

        @include('includes.foot')

    </body>
</html>
