<!DOCTYPE html>
<html lang="@yield('lang', 'ru')">
    <head>
        @include('includes.head')
    </head>
    <body class="sb-nav-fixed @yield('body-class')">
    
        @include('includes.nav')
    
        <div id="layoutSidenav">
            @auth
                @include('includes.sidebar')
            @endauth

            <div id="layoutSidenav_content" class="@guest pl-0 @endguest">
                <main class="@yield('main-class')">
                    <div class="pt-1 @yield('container-class', 'container-fluid')">
                        
                        @yield('breadcrumb')

                        @if($success ?? session('success') ?? false)
                            <x-alert type="success" :message="$success ?? session('success')"/>
                        @endif
                        @if($errors->any())
                            <x-alert type="danger" :message="$errors->any()"/>
                        @endif

                        @yield('content')
                        
                    </div>
                </main>
                
                @include('includes.footer')

            </div>
        </div>

        @stack('modals')

        @include('includes.foot')

    </body>
</html>
