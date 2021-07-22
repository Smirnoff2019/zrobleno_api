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
                <main class="pt-1 @yield('main-class')">
                    <div class="pt-2 @yield('container-class', 'container-fluid')">
                        
                        @if(Breadcrumbs::exists(Route::currentRouteName()))
                            {{ Breadcrumbs::render(
                                    Route::currentRouteName(), 
                                    $current_record ?? $records ?? $record ?? null
                            ) }}
                        @endif

                        @if($success ?? session('success') ?? false)
                            <x-alert type="success" :message="$success ?? session('success')"/>
                        @endif
                        @if($errors->any())
                            <x-alert type="danger" :message="$errors->first()"/>
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
