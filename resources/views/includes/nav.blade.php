                    {{-- @dd($request->user()->notifications) --}}
<nav class="sb-topnav navbar navbar-expand @yield('navbar-theme', 'navbar-dark bg-dark')">
    <a class="navbar-brand" href="{{ route('admin.home') }}">Зроблено Admin</a>
    @auth()
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <form class="d-none *d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto *ml-md-0">
        {{-- <li class="nav-item" title="Сайт - Главная [в новом окне]">
            <a class="nav-link" href="https://main.zrobleno.com.ua/" title="Сайт - Главная [в новом окне]">
                <i class="fas fa-bookmark"></i>
            </a>
        </li>
        <li class="nav-item" title="Сайт - Главная [в новом окне]">
            <a class="nav-link" href="https://main.zrobleno.com.ua/" title="Сайт - Главная [в новом окне]">
                <i class="fas fa-bookmark"></i>
            </a>
        </li>
        <li class="nav-item" title="Сайт - Главная [в новом окне]">
            <a class="nav-link" href="https://main.zrobleno.com.ua/" title="Сайт - Главная [в новом окне]">
                <i class="fas fa-bookmark"></i>
            </a>
        </li> --}}
        <li class="nav-item dropdown">
            <a class="nav-link mr-2 notifications-menu-icon" id="sitemapDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right px-4 pb-3 pt-4 shadow-lg notifications-menu" aria-labelledby="sitemapDropdown">
                @forelse ($request->user()->notifications()->latest()->take(6)->get() as $notification)
                    <div class="alert shadow-sm border
                        @if($notification->read_at) border-silver @endif
                        @switch($notification->data['status'] ?? '')
                            @case('information')
                                alert-info @if(!$notification->read_at) border-info @endif
                                @break
                            @case('error')
                                alert-error @if(!$notification->read_at) border-error @endif
                                @break
                            @case('success')
                                alert-success @if(!$notification->read_at) border-success @endif
                                @break
                        
                            @default
                            border-silver
                        @endswitch
                    " role="alert">
                        <h5 class="alert-heading mb-">{{ $notification->data['title'] }}</h5>
                        <p>{{ $notification->data['content'] }}</p>
                    </div>
                @empty
                    <p class="dropdown-item">Сповіщень поки немає</p>
                @endforelse
                <div class="dropdown-divider mt-4"></div>
                <a class="dropdown-item text-center text-primary font-w-500" href="{{ route('admin.notifications.index') }}">Переглянути всі сповіщення</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="sitemapDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-globe-asia"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="sitemapDropdown">
                <a class="dropdown-item" href="https://main.zrobleno.com.ua/">Сайт - Главная</a>
                <a class="dropdown-item" href="https://auth.zrobleno.com.ua/">Сервис авторизации</a>
                <a class="dropdown-item" href="https://customer.zrobleno.com.ua/">ЛК заказчика</a>
                <a class="dropdown-item" href="https://contractor.zrobleno.com.ua/">ЛК подрядчика</a>
            </div>
        </li>
        <li class="nav-item dropdown ml-4">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="userDropdown">
                <h5 class="dropdown-item font-w-500">{{ $request->user()->first_name }} {{ $request->user()->last_name }}</h5>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Профиль</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.logout') }}">Выйти</a>
            </div>
        </li>
    </ul>
    @endauth
</nav>