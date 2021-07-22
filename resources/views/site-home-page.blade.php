<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Главная</title>

    <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('fonts/icomoon-zrb-home-page/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('libs/owlcarousel/dist/assets/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('libs/owlcarousel/dist/assets/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/site.home.css') }}" rel="stylesheet" />

    @stack('head')

</head>
<body class="">
        <main class="container-fluid px-0">
            <header class="d-flex justify-content-between w-100 px-5 py-3">
                <a href="#">
                    <img src="{{ asset('icons/logo.svg') }}" alt="logo.svg">
                </a>
                <a href="#">
                    <img src="{{ asset('icons/menu.svg') }}" alt="menu.svg">
                </a>
            </header>

            <section id="section-1" class="section-1 d-flex mx-0">
                <div class="poster bg-white">
                    <h1 class="display-4 font-weight-bold poster-title mb-5">Zrobleno.ua  головний калькулятор ремонтів країни</h1>
                    <p class="poster-subtitle font-weight-bold mb-3 fs-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                    <p class="poster-text mb-5">Pellentesque et porta nibh. Duis a interdum nulla, ut congue dui. Proin nisi nulla, commodo vel imperdiet ut, dapibus consectetur orci. Integer eros felis, dignissim ac hendrerit commodo, gravida vitae dui. </p>
                    <div>
                        <a href="#" class="poster-link-btn">Почати ремонт</a>
                    </div>
                </div>
                <div class="slider h-100 px-0">
                    <div class="owl-carousel h-100 d-flex align-items-center">
                        <div class="item-video">
                            <a class="owl-video" href="https://www.youtube.com/watch?v=lUKk0EfOexQ"></a>
                        </div>
                        <div class="item-video">
                            <a class="owl-video" href="https://www.youtube.com/watch?v=CyQBI0b7aXA"></a>
                        </div>
                        <div class="item-video">
                            <a class="owl-video" href="https://www.youtube.com/watch?v=lUKk0EfOexQ"></a>
                        </div>
                    </div>
                    <div class="slider-controls">
                        <div class="controls d-flex align-items-center">
                            <div class="scopes d-flex align-items-center">
                                <span class="current">01</span>
                                <span class="separator">/</span>
                                <span class="total">05</span>
                            </div>
                            <div class="dots d-flex mx-5"></div>
                            <div class="navs d-flex"></div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    
    {{-- Foot --}}
        <script src="{{ asset('admin/js/jquery-3.5.1.min.js') }}"></script>
        {{-- <script src="{{ asset('admin/js/scripts.js') }}"></script> --}}
        <script src="{{ asset('libs/owlcarousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/site.home.js') }}"></script>

        @stack('foot')
    {{-- end Foot --}}

</body>
</html>