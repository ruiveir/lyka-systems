<!DOCTYPE html>
<html lang="pt" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Ficha de agente - {{$agent->nome}} {{$agent->apelido}}</title>

    <!-- Favicon -->
    <!-- Bootstrap core CSS -->
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- Lyka Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">


    <!-- Fontawesome core CSS -->
    <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel=" stylesheet" type="text/css">



    <style>
        div{
            font-size: 13pt;
            line-height: 20pt;
        }

        @media print {
            body {
                width: 21cm;
                height: 29.7cm;
                margin: 10mm 20mm 10mm 20mm;
                /* change the margins as you want them to be. */
            }
        }

    </style>

</head>

<body onload="javascript:window.print()">

    <div class="container-fluid">

        <br>
        <hr style="border:1px solid lightgray"><br>
    </div>
</body>
</html>
