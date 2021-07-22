<!DOCTYPE html>
<html lang="ru">
    <head>
        @include('includes.head')
    </head>
    <body class="@yield('body_class')">

        @yield('content')

        @include('includes.foot')
    </body>
</html>
