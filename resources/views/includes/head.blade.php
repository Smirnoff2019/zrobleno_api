<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />

<meta name="base_url" content="{{ env('APP_URL') }}" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', Breadcrumbs::pageTitle())</title>

<link rel="shortcut icon" href="/icons/favicon.ico" type="image/x-icon">

<link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet" />
{{-- <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" /> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
<link href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css" rel="stylesheet" />
<link href="{{ asset('css/app.css') }}?v={{ time() }}" rel="stylesheet" />
{{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script> --}}

@stack('head')
