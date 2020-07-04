<!DOCTYPE html>
<html lang="pt" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') - Lyka Systems</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/media/favicon.png') }}" type="image/x-icon">
    <!-- Scripts -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('/css/auth.css') }}" rel="stylesheet">
</head>

<body>
    <div class="background">
        @yield('content')
        <div class="copyright">
            <p class="text-center">© {{ date('Y') }} Direitos de autor. Lyka Systems todos os direitos reservados.</p>
        </div>
    </div>
    @hasSection('scripts')
        <script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        @yield('scripts')
    @endif
</body>

</html>
