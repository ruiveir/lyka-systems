<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Lyka Systems</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/media/favicon.png') }}" type="image/x-icon">
    <!-- Fontawesome core CSS -->
    <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel=" stylesheet" type="text/css">
    <!-- Lyka Font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- CSS Link -->
    <link href="{{asset("/css/sb-admin-2.css")}}" rel="stylesheet">
    <link href="{{asset("/css/modal.css")}}" rel="stylesheet">
    @yield('style')
</head>

<body class="bg-gradient-primary">
    <!-- Begin of content-->
    @yield('content')

    @hasSection('scripts')
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- SBAdmin JavaScript-->
    <script src="{{asset('/js/sb-admin-2.min.js')}}"></script>
    @yield('scripts')
    @endif
</body>

</html>
