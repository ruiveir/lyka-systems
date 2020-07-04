<!DOCTYPE html>
<html lang="pt" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Erro no servidor - Lyka Systems</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/media/favicon.png" type="image/x-icon">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Fontawesome core CSS -->
    <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel=" stylesheet" type="text/css">

    <!-- Lyka Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS Link -->
    <link href="{{asset('css/errors.css')}}" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row mt-5 ">
            <div class="col text-center border-danger" style="width:500px">

                <a class="logo" href="{{route('dashboard')}}">lyka.</a>
                <br><br>

                <div class="row">
                    <div class="col mr-4 card rounded-lg p-5 shadow">
                        <div class="text-danger" style="text-transform: uppercase; font-size:40px">Erro 500</div><br>
                        <div><strong>Ocurreu um erro no servidor. Tente mais tarde.</strong><br><small >Se o problema persistir, contacte o administrador</small></div>
                        <br><hr style="margin: 0 20%"><br>
                        <div><a class="links" href="javascript:history.go(-1)" title="Voltar"><i class="fas fa-arrow-left mr-1"></i>
                        Voltar para a página anterior</a></div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>

</html>
