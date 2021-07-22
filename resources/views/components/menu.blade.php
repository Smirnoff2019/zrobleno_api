@foreach($sections ?? [] as $section_name => $tabs)
                    
    <div class="sb-sidenav-menu-heading pt-3">{{ $section_name }}</div>

    @foreach($tabs as $tab_index => $tab)
    <div class="menu-item">
        <a class="menu-nav-link nav-link py-2" href="{{ $tab->url ?? '#' }}">
            <div class="menu-nav-link--icon sb-nav-link-icon"><i class="fas {{ $tab->icon ?? '' }}"></i></div>
            <span class="menu-nav-link--label">{{ $tab->label ?? 'Label not found...' }}</span>
        </a>

        @if($tab->collapse ?? false)
            <ul class="submenu text-nowrap list-unstyled mb-2">
                @foreach($tab->collapse ?? [] as $collapse_tab)
                    <li class="submenu-nav">
                        <a  class="submenu-nav-link nav-link pr-4" href="{{ $collapse_tab->url ?? '#' }}">{{ $collapse_tab->label }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    @endforeach

@endforeach