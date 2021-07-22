<div class="page" style="height: 1390px">
    <div class="container h-100 d-flex flex-column p-0 page-viewport">
        <div class="header mb-3">
            <div class="logo header__logo" style="background: #FCD016;">
                @include('includes.logo-svg')
            </div>
            <div class="header__contacts d-flex">
                <div class="contact contact_tel header__contact d-flex align-items-center mx-2 ml-3">
                    <p class="contact__info text-right">@include('includes.icons.phone-svg') <span>Телефон:</span><br><a href="tel:+380677162385">+380 67 716 23 85</a></p>
                </div>
                <div class="contact contact_email header__contact d-flex align-items-center mx-2 ml-3">
                    <p class="contact__info text-right">@include('includes.icons.mail-svg') <span>Email:</span><br><a href="mailto:info@zrobleno.com.ua">info@zrobleno.com.ua</a></p>
                </div>
                <div class="contact contact_address header__contact d-flex align-items-center mx-2 ml-3">
                    <p class="contact__info text-right">@include('includes.icons.placeholder-svg') <span>Україна, Київ</span><br><span>вул. Вадима Гетьмана, 1-а</span></p>
                </div>
            </div>
        </div>
        <div class="body">
            <div class="row mb-4">
                <div class="params-card d-flex flex-column col-6">
                    <h3 class="font-weight-bold mb-3">Параметри об’єкту</h3>
                    <p class="row border-bottom mx-0 py-2 mb-1">
                        <span class="text-muted col-7 px-0">Область</span>
                        <span class="col-5 px-0">{{ $record->project->region->name }}</span>
                    </p>
                    <p class="row border-bottom mx-0 py-2 mb-1">
                        <span class="text-muted col-7 px-0">Місто</span>
                        <span class="col-5 px-0">{{ $record->project->city }}</span>
                    </p>
                    <p class="row border-bottom mx-0 py-2 mb-1">
                        <span class="text-muted col-7 px-0">Статус об’єкту</span>
                        <span class="col-5 px-0">{{ $record->project->propertyCondition->name }}</span>
                    </p>
                    <p class="row border-bottom mx-0 py-2 mb-1">
                        <span class="text-muted col-7 px-0">Cтан стін</span>
                        <span class="col-5 px-0">{{ Str::lower($record->project->wallsCondition->name)}}</span>
                    </p>
                    <p class="row border-bottom mx-0 py-2 mb-5">
                        <span class="text-muted col-7 px-0">Висота стелі</span>
                        <span class="col-5 px-0">{{ $record->project->ceilingHeight->name }}</span>
                    </p>
                    <div class="params-card__footer mt-auto">
                        <span class="label">Разом:</span>
                        <span class="price font-weight-bold">{{ number_format($record->project->total_price ?? 0, 0, '.', ' ') }} грн.</span>
                    </div>
                </div>
                <div class="params-card d-flex flex-column col-6">
                    <h3 class="font-weight-bold mb-3">Вибір кімнат</h3>
                    @foreach ($record->project->rooms->groupBy('name') as $group)
                            <p class="row @if (!$loop->last) border-bottom @endif mx-0 py-2 pr-3 mb-1">
                                <span class="col px-0">{{ $group[0]->room->name }} <span class="text-muted">({{ $group->count() }})</span></span>
                                <span class="col-auto">
                                    @foreach ($group as $room)
                                        {{ $room->area }}м<sup>2</sup>
                                        @if (!$loop->last) / @endif
                                    @endforeach
                                </span>
                            </p>
                    @endforeach
                    <div class="params-card__footer mt-auto">
                        <span class="label">Загальна плоша:</span>
                        <span class="price font-weight-bold">{{ $record->project->total_area }} м<sup>2</sup></span>
                    </div>
                </div>
            </div>
        @foreach ($record->project->rooms->groupBy('name') as $group)
            @foreach ($group as $room)
            <div class="row mb-3 room-card">
                <h4 class="col-12 room-card__header font-weight-bold">
                    {{ $room->room->name }}
                    @if($group->count() > 1) 
                        {{ $loop->iteration }}
                    @endif
                    <span class="text-muted font-w-500 fs-3">({{ $room->area }}м<sup>2</sup>)</span>
                </h4>
                <div class="col-12 table table-sm table-borderless room-card__table">
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th class="text-center">№</th>
                                <th>Категорія</th>
                                <th>Обрано</th>
                                <th>Ціна</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($room->options as $option)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $option->option->optionsGroup->name }}</td>
                                <td>{{ $option->option->name }}</td>
                                <td>@nformat($option->price) грн.</td>
                            </tr>
                            @endforeach
                            </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td colspan="2">Загальні роботи та матеріали ремонту:</td>
                                <td>@nformat($room->options->sum('price')) грн.</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            @if($loop->parent->iteration == 2 || $loop->parent->iteration == 4) 
            @if(!$loop->parent->last)        
        </div>
        <div class="footer mt-auto">
            <div class="logo footer__logo">
                @include('includes.logo-svg')
            </div>
            <p class="footer__contacts text-right">Україна, Київ, вул. Вадима Гетьмана, 1-а<br><a href="tel:+380677162385">+380 67 716 23 85</a>&nbsp;|&nbsp;<a href="mailto:info@zrobleno.com.ua">info@zrobleno.com.ua </a></p>
        </div>
    </div>
</div>
<div class="page" style="height: 1390px">
    <div class="container h-100 d-flex flex-column p-0 page-viewport">
        <div class="header mb-3">
            <div class="logo header__logo" style="background: #FCD016;">
                @include('includes.logo-svg')
            </div>
            <div class="header__contacts d-flex">
                <div class="contact contact_tel header__contact d-flex align-items-center mx-2 ml-3">
                    <p class="contact__info text-right">@include('includes.icons.phone-svg') <span>Телефон:</span><br><a href="tel:+380677162385">+380 67 716 23 85</a></p>
                </div>
                <div class="contact contact_email header__contact d-flex align-items-center mx-2 ml-3">
                    <p class="contact__info text-right">@include('includes.icons.mail-svg') <span>Email:</span><br><a href="mailto:info@zrobleno.com.ua">info@zrobleno.com.ua</a></p>
                </div>
                <div class="contact contact_address header__contact d-flex align-items-center mx-2 ml-3">
                    <p class="contact__info text-right">@include('includes.icons.placeholder-svg') <span>Україна, Київ</span><br><span>вул. Вадима Гетьмана, 1-а</span></p>
                </div>
            </div>
        </div>
        <div class="body">
        @endif
        @endif
    @endforeach
@endforeach
        </div>
        <div class="footer mt-auto">
            <div class="logo footer__logo">
                @include('includes.logo-svg')
            </div>
            <p class="footer__contacts text-right">Україна, Київ, вул. Вадима Гетьмана, 1-а<br><a href="tel:+380677162385">+380 67 716 23 85</a>&nbsp;|&nbsp;<a href="mailto:info@zrobleno.com.ua">info@zrobleno.com.ua </a></p>
        </div>
    </div>
</div>
        
<div class="page" style="height: 1390px">
    <div class="container h-100 d-flex flex-column p-0 page-viewport">
        <div class="header mb-3">
            <div class="logo header__logo" style="background: #FCD016;">
                @include('includes.logo-svg')
            </div>
            <div class="header__contacts d-flex">
                <div class="contact contact_tel header__contact d-flex align-items-center mx-2 ml-3">
                    <p class="contact__info text-right">@include('includes.icons.phone-svg') <span>Телефон:</span><br><a href="tel:+380677162385">+380 67 716 23 85</a></p>
                </div>
                <div class="contact contact_email header__contact d-flex align-items-center mx-2 ml-3">
                    <p class="contact__info text-right">@include('includes.icons.mail-svg') <span>Email:</span><br><a href="mailto:info@zrobleno.com.ua">info@zrobleno.com.ua</a></p>
                </div>
                <div class="contact contact_address header__contact d-flex align-items-center mx-2 ml-3">
                    <p class="contact__info text-right">@include('includes.icons.placeholder-svg') <span>Україна, Київ</span><br><span>вул. Вадима Гетьмана, 1-а</span></p>
                </div>
            </div>
        </div>
        <div class="body">
            
            <div class="row mb-4">
                <div class="col-6">
                    <p class="font-weight-bold">У вартість ремоту ЗРОБЛЕНО входять:</p>
                </div>
                <div class="col-6">
                    <div class="artext-list">
                        <p class="font-weight-bold mb-1">1. Розробка технічного проекту квартири</p>
                        <p class="font-weight-bold mb-1">2. Чистові та чорнові матеріали ремонту</p>
                        <p class="font-weight-bold mb-1">3. Всі види робіт</p>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <h5 class="font-weight-bold mb-3"><span class="px-3 py-1 bg-warning">Кухня:</span></h5>
                    <ol class="pl-4">
                        <li class="mb-1">Натяжна стеля з точковими світильниками</li>
                        <li class="mb-1">Пофарбовані стіни з встановленими плінтусом, розетками та вимикачами</li>
                        <li class="mb-1">Ламинат на підлозі</li>
                        <li class="mb-1">Міжкімнатні двері з фурнітурою</li>
                        <li class="mb-1">Фартук з керамічної плитки у зоні кухонних меблів</li>
                        <li class="mb-1">Розведені гарячої та холодної води від відсічних кранів і каналізації до місця встановлення кухонної мийки та посудомийної машини</li>
                        <li class="mb-1">Встановлені силові роз'єми для варильної поверхні, духової шафи та витяжки</li>
                        <li class="mb-1">Встановлені розетки для стаціонарного електроустаткування кухні</li>
                        <li class="mb-1">Встановлене підвіконня</li>
                    </ol>
                </div>
                <div class="col-6">
                    <h5 class="font-weight-bold mb-3"><span class="px-3 py-1 bg-warning">Санвузол:</span></h5>
                    <ol class="pl-4">
                        <li class="mb-1">Натяжна стеля з точковими світильниками</li>
                        <li class="mb-1">Керамічна плитка на підлозі та стінах</li>
                        <li class="mb-1">Розведені гаряча та холодна вода від відсічних кранів і каналізації до місць встановлення сантехнічних приборів </li>
                        <li class="mb-1">Підведена холодна вода і каналізація до місця встановлення пральної машини</li>
                        <li class="mb-1">Встановлено ревізійний люк</li>
                        <li class="mb-1">Ванна</li>
                        <li class="mb-1">Скляна шторка</li>
                        <li class="mb-1">Умивальник </li>
                        <li class="mb-1">Унітаз</li>
                        <li class="mb-1">Душова стійка з лійкою та змішувачами</li>
                        <li class="mb-1">Сушарка для рушників</li>
                        <li class="mb-1">Дзеркало</li>
                        <li class="mb-1">Витяжний вентилятор</li>
                        <li class="mb-1">Встановлені розетки та вимикачі</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <h5 class="font-weight-bold mb-3"><span class="px-3 py-1 bg-warning">Кімната:</span></h5>
                    <ol class="pl-4">
                        <li class="mb-1">Натяжна стеля з точковими світильниками</li>
                        <li class="mb-1">Пофарбовані стіни з встановленими плінтусом, розетками та вимикачами</li>
                        <li class="mb-1">Ламінат на підлозі</li>
                        <li class="mb-1">Міжкімнатні двері з фурнітурою</li>
                        <li class="mb-1">Встановлені розетки для TV і для інтернету </li>
                        <li class="mb-1">Встановлене підвіконня</li>
                    </ol>
                </div>
                <div class="col-6">
                    <h5 class="font-weight-bold mb-3"><span class="px-3 py-1 bg-warning">Коридор:</span></h5>
                    <ol class="pl-4">
                        <li class="mb-1">Натяжна стеля з точковими світильниками</li>
                        <li class="mb-1">Ламінат на підлозі</li>
                        <li class="mb-1">Пофарбовані стіни з встановленими плінтусом, розетками та вимикачами</li>
                        <li class="mb-1">Встановлений силовий щит з однолінійною схемою та маркуванням апаратів захисту</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <h5 class="font-weight-bold mb-3"><span class="px-3 py-1 bg-warning">Лоджія:</span></h5>
                    <ol class="pl-4">
                        <li class="mb-1">Гіпсокартонна стеля </li>
                        <li class="mb-1">Пофарбовані стіни</li>
                        <li class="mb-1">Керамічна плитка на підлозі</li>
                        <li class="mb-1">Прибори освітлення </li>
                        <li class="mb-1">Встановлені розетки та вимикачі</li>
                    </ol>
                </div>
            </div>
            
        </div>
        <div class="footer mt-auto">
            <div class="logo footer__logo">
                @include('includes.logo-svg')
            </div>
            <p class="footer__contacts text-right">Україна, Київ, вул. Вадима Гетьмана, 1-а<br><a href="tel:+380677162385">+380 67 716 23 85</a>&nbsp;|&nbsp;<a href="mailto:info@zrobleno.com.ua">info@zrobleno.com.ua </a></p>
        </div>
    </div>
</div>