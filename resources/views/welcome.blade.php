<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                font-family: 'Roboto', sans-serif;
                color: #636b6f;
                margin: 0 15px;
                font-size: 13px;
                font-weight: 500;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                padding: 5px 10px;
                border: 1px solid transparent;
            }

            .links > a:hover {
                color: rgb(177, 138, 30);
                border: 1px solid rgb(177, 138, 30);
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('admin.home') }}">Admin Panel</a>
                        <a href="{{ route('admin.logout') }}">Logout</a>
                    @else
                        <a href="{{ route('admin.login') }}">Login</a>

                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif --}}
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Zrobleno App
                </div>

                <div class="links">
                    <a target="_blank" href="https://zrobleno.com.ua">zrobleno.com.ua</a>
                    <a target="_blank" href="https://app.zrobleno.com.ua">app.zrobleno.com.ua</a>
                    <a target="_blank" href="https://bot.zrobleno.com.ua">bot.zrobleno.com.ua</a>
                    <a target="_blank" href="https://auth.zrobleno.com.ua">auth.zrobleno.com.ua</a>
                    <a target="_blank" href="https://customer.zrobleno.com.ua">customer.zrobleno.com.ua</a>
                    <a target="_blank" href="https://contractor.zrobleno.com.ua">contractor.zrobleno.com.ua</a>
                </div>
            </div>
        </div>
    </body>
</html>
