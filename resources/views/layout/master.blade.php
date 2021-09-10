<!DOCTYPE html>
<html lang="pt" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> @yield('title') - Lyka Systems</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('/media/favicon.png')}}" type="image/x-icon">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- DataTables -->
    <link type="text/css" href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!-- Fontawesome core CSS -->
    <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel=" stylesheet" type="text/css">

    <!-- Lyka Font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- CSS Link -->
    <link href="{{asset("/css/style.css")}}" rel="stylesheet">
    <link href="{{asset("/css/modal.css")}}" rel="stylesheet">

    @yield('style-links')

    <!-- Notificações -->
    @php
    use App\Cliente;
    $clientesNotificacao = Cliente::all();
    $notifications = Auth()->user()->getNotifications();
    @endphp
</head>

<body id="page-top">
    <!-- Modal de contactos  -->
    @include('layout.partials.modal-contactos')
    <!-- Modal para terminar a sessão -->
    @include('layout.partials.modal-logout')

    <div id="wrapper">
        <!-- Sidebar -->
        @include('layout.partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('layout.partials.topbar')

                <!-- Success message on forms -->
                @if (!empty(session('success')))
                @include('layout.msg-error-message.partials.success')
                @endif

                <!-- Error message on forms -->
                @if ($errors->any())
                @include ('layout.msg-error-message.partials.errors')
                @endif

                <!-- Content -->
                @yield('content')
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Estudar Portugal {{date("Y")}}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>

    <!-- Scripts -->
    @include('layout.partials.footer')
    <script>
        var authenticatedUserId = {!! Auth()->user()->idUser !!};

        $(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });
        });
    </script>
    <script src="{{asset('/js/master.js')}}"></script>
</body>

</html>
