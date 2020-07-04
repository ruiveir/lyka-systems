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
        div {
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

        <div class="row ">


            <div class="col">
                <h3><i class="fas fa-user-graduate mr-2"></i>
                    @if ($agent->tipo=="Agente")
                    Ficha de Agente
                    @else
                    Ficha de Subagente
                    @endif
                </h3>
                <hr style="border:1px solid lightgray"><br>

                {{-- Informações Pessoais --}}
                <div class="row">
                    <div class="col">
                        <div><span class="text-secondary font-weight-bold">Nome:</span> {{$agent->nome}}
                            {{$agent->apelido}}</div>

                        <div><span class="text-secondary font-weight-bold">Género:</span>
                            @if ($agent->genero == 'M')
                            Masculino
                            @else
                            Feminino
                            @endif
                        </div>

                        <div><span class="text-secondary font-weight-bold">Data de nascimento:
                            </span>{{ date('d-M-y', strtotime($agent->dataNasc)) }}</div><br>



                    </div>

                </div>


                <div><span class="text-secondary font-weight-bold">País:</span> {{$agent->pais}}</div>

                <div><span class="text-secondary font-weight-bold">Morada:</span> {{$agent->morada}}</div><br>



                <div><span class="text-secondary font-weight-bold">Telefone:</span> {{$agent->telefone1}}
                    @if ($agent->telefone2!=null)
                    / {{$agent->telefone2}}
                    @endif

                </div>

                <div><span class="text-secondary font-weight-bold">E-mail:</span> {{$agent->email}}</div><br>

                <div><span class="text-secondary font-weight-bold">Número de identificação pessoal:</span> {{$agent->num_doc}}</div>

                <div><span class="text-secondary font-weight-bold">NIF:</span> {{$agent->NIF}}</div><br>

                <div><span class="text-secondary font-weight-bold">Adicionado em:
                    </span>{{ date('d-M-y', strtotime($agent->created_at)) }}</div><br>

            </div>

            {{-- Fotografia --}}
            <div class="col col-3">

                @if($agent->fotografia)
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('agent-documents/'.$agent->idAgente.'/').$agent->fotografia}}" style="width:90%">
                @elseif($agent->genero == 'F')
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" style="width:90%">
                @else
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:90%">
                @endif

            </div>

        </div>

{{--         <br>
        <hr style="border:1px solid lightgray"><br>

        <div class="row text-center">

            <div class="col text-center">

                @if ($agent->img_doc)
                    <div><span class="text-secondary font-weight-bold">Documento de identificação:</div><br>
                        <embed src="{{Storage::disk('public')->url('agent-docs/').$agent->img_doc}}#toolbar=0" width="70%" height="900px">

                @endif

            </div>
        </div> --}}

    </div>

</body>

</html>
