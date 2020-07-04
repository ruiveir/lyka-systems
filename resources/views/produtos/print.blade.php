<!DOCTYPE html>
<html lang="pt" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Ficha de estudante - {{$client->nome}} {{$client->apelido}}</title>

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

        <div class="row ">


            <div class="col">
                <h3><i class="fas fa-user-graduate mr-2"></i>Ficha de estudante</h3>
                <hr style="border:1px solid lightgray"><br>

                {{-- Informações Pessoais --}}
                <div><span class="text-secondary font-weight-bold">Nome:</span> {{$client->nome}} {{$client->apelido}}
                </div>

                <div><span class="text-secondary font-weight-bold">Naturalidade:</span> {{$client->paisNaturalidade}}
                </div>

                <div><span class="text-secondary font-weight-bold">Data de nascimento:
                    </span>{{ date('d-M-y', strtotime($client->dataNasc)) }}</div>

                <div><span class="text-secondary font-weight-bold">Telefone:</span> {{$client->telefone1}}
                    @if ($client->telefone2!=null)
                    / {{$client->telefone2}}
                    @endif

                </div>

                <div><span class="text-secondary font-weight-bold">E-mail:</span> {{$client->email}}</div>

                <div><span class="text-secondary font-weight-bold">Observações pessoais:</span>
                    @if ($client->obsPessoais==null)
                    <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                    @else
                    {{ $client->obsPessoais }}
                    @endif
                </div><br>

                <div><span class="text-secondary font-weight-bold">Adicionado em: </span>{{ date('d-M-y', strtotime($client->created_at)) }}</div><br>

            </div>

            {{-- Fotografia --}}
            <div class="col col-3">
                @if ($client->fotografia==null)
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('client-photos/default.png')}}" style="width:90%">
                @else
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('client-photos/').$client->fotografia}}" style="width:90%">
                @endif

            </div>

        </div>

        <hr style="border:1px solid lightgray"><br>


        <div class="row ">

            <div class="col p-3 mr-3 ">
                <h5><i class="fas fa-passport mr-2"></i>Passaporte</h5><br>
                {{--  numPassaporte --}}
                <div><span class="text-secondary font-weight-bold">Número do passaporte:</span>
                    {{$client->numPassaporte}}</div>

                {{--  dataValidPP --}}
                <div><span class="text-secondary font-weight-bold">Data de validade do passaporte:</span>
                    {{$client->dataValidPP}}</div>

                {{--  passaportPaisEmi --}}
                <div><span class="text-secondary font-weight-bold">Pais emissor do passaporte:</span>
                    {{$client->passaportPaisEmi}}</div>

                {{--  localEmissaoPP --}}
                <div><span class="text-secondary font-weight-bold">Local de emissão do passaporte:</span>
                    {{$client->localEmissaoPP}}</div><br>
            </div>

            <div class="col p-3 ">
                <h5><i class="far fa-id-card mr-2"></i>Documento de identificação</h5><br>
                <div><span class="text-secondary font-weight-bold">Número de cartão de cidadão:</span>
                    {{$client->numCCid}}</div>
                <div><span class="text-secondary font-weight-bold">Número de identificação fiscal:</span>
                    {{$client->NIF}}</div>
            </div>


        </div>

        <hr style="border:1px solid lightgray"><br>


        <div class="row">

            <div class="col mr-4 ">

                <h5><i class="fas fa-university mr-2"></i>Dados académicos</h5><br>
                {{-- Informações Escolares --}}
                <div><span class="text-secondary font-weight-bold">Nivel de estudos(atual):</span>
                    {{$client->nivEstudoAtual}}
                </div>

                <div><span class="text-secondary font-weight-bold">Nome da instituição de origem:</span>
                    {{$client->nomeInstituicaoOrigem}}</div>

                <div><span class="text-secondary font-weight-bold">Local da instituição:</span>
                    {{$client->cidadeInstituicaoOrigem}}</div>

            </div>

            <div class="col ">
                {{-- Observações académicas --}}
                <div><span class="text-secondary font-weight-bold">Observações académicas:</span>

                    @if ($client->obsAcademicas==null)
                    <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                    @else
                    {{$client->obsAcademicas}}
                    @endif
                </div>
            </div>

        </div>


        <br>
        <hr style="border:1px solid lightgray"><br>


        <div class="row">

            <div class="col">
                <h5><i class="far fa-address-book mr-2"></i>Contactos</h5><br>
                {{-- Morada em Portugal --}}
                <div><span class="text-secondary font-weight-bold">Morada de residência (Portugal):</span> {{$client->moradaResidencia}}</div>

                {{-- Morada de residência no pais de origem --}}
                <div><span class="text-secondary font-weight-bold">Morada (origem):</span> {{$client->morada}}</div>
                <div><span class="text-secondary font-weight-bold">Cidade (origem):</span> {{$client->cidade}}</div>
            </div>
            <div class="col pt-4">
                {{-- Contactos dos pais --}}
                <div><span class="text-secondary font-weight-bold">Nome do pai:</span>{{$client->nomePai}}</div>
                <div><span class="text-secondary font-weight-bold">Telefone do pai:</span> {{$client->telefonePai}}</div>
                <div><span class="text-secondary font-weight-bold">E-mail do pai:</span> {{$client->emailPai}}</div>
                <div><span class="text-secondary font-weight-bold">Nome da mãe:</span> {{$client->nomeMae}}</div>
                <div><span class="text-secondary font-weight-bold">Telefone da mãe:</span> {{$client->telefoneMae}}</div>
                <div><span class="text-secondary font-weight-bold">E-mail da mãe:</span> {{$client->emailMae}}</div>
            </div>

        </div>

        <br>
        <hr style="border:1px solid lightgray"><br>


        <div class="row">
            <div class="col">
                <div><i class="fas fa-stream mr-2 "></i><span class="text-secondary font-weight-bold">Produtos aquiridos:</span>
                    curso1, curso2, curso3, curso4,
                </div>
            </div>
        </div>

        <br>
        <hr style="border:1px solid lightgray"><br>

        <div class="row">

            <div class="col">
                <div><span class="text-secondary font-weight-bold">Observações Financeiras:</span>

                    @if ($client->obsFinanceiras==null)
                    <span class="text-muted font-weight-bold"><small>(sem dados para mostrar)</small></span>
                    @else
                    {{$client->obsFinanceiras}}
                    @endif
                </div>
            </div>

            <div class="col">
                <div><i class="fas fa-search-dollar mr-2"></i><span class="text-secondary font-weight-bold">IBAN:</span> {{$client->IBAN}}</div>
            </div>

        </div>

    </div>

</body>

</html>






</div>
