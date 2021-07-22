<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
    <!--meta information starts-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="metaDescription">
    <meta name="keywords" content="metaKeywords">
    <!--meta information ends-->

    <!-- title starts-->
    <title>@yield('title', 'ТЗ робіт')</title>
    <!-- title ends-->

    <!--favicon starts-->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/images/pdf/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/images/pdf/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('/images/pdf/favicon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('/images/pdf/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <link rel="shortcut icon" href="{{asset('/images/pdf/favicon/favicon.ico')}}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="{{asset('/images/pdf/favicon/browserconfig.xml')}}">
    <meta name="theme-color" content="#ffffff">
    <!--favicons ends-->

    <!--styles-->
    <link href="{{ asset('css/bootstrap-4/css/bootstrap.min.css') }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{asset('/images/pdf/css/pdf.css')}}"> --}}
    <link href="{{ asset('css/document.css') }}" rel="stylesheet" />
    <!--styles ends-->
</head>
<body class="page" id="page">

    <!-- main header starts-->
    <style type="text/css">
        .container {
            width: 950px;
            background-color: #fff;
            box-shadow: 0px 0px 0px 40px #fff;
        }
        .page{
            background-color: #525659;
            margin-top: 100px;
            margin-bottom: 100px;
        }
    </style>
    <!-- main header ends-->
    <!-- main footer starts-->
    <main class="main" id="main">

        @yield('content')
        
    </main>
    <!-- main footer ends-->

</body>
</html>

