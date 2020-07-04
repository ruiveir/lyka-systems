@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Verificacao de um documento')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/providers.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')
<div class="container mt-2 ">

    {{-- Navegação --}}
    <div class="float-left buttons">
        <a href="javascript:history.go(-1)" title="Voltar">
            <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
        </a>
        <a href="javascript:window.history.forward();" title="Avançar">
            <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
        </a>
    </div>

    <br><br>

    <div class="cards-navigation">
        <div class="title">
            <h6>Verificação do {{$tipo}}:</h6>
        </div>
        <br>
        <div class="formulario-edicao shadow-sm">
            {{--@if(strtolower($tipo) == "transacao")
                <div class="row documento-transacao">
                    <div class="col-md-12">
                        <div><span class="text-secondary ">Descrição:</span> {{$documento->descricao}}</div><br>
                    </div>
                    <div class="col-md-2">
                        <div><span class="text-secondary ">Valor recebido:</span> {{$documento->valorRecebido}}</div><br>
                    </div>
                    <div class="col-md-4">
                        <div><span class="text-secondary ">Tipo pagamento:</span> {{$documento->tipoPagamento}}</div><br>
                    </div>
                    <div class="col-md-3">
                        <div><span class="text-secondary ">Data da operação:</span> {{$documento->dataOperacao}}</div><br>
                    </div>
                    <div class="col-md-3">
                        <div><span class="text-secondary ">Data recebido:</span> {{$documento->dataRecebido}}</div><br>
                    </div>
                    <div class="col-md-12">
                        <div>
                            <span class="text-secondary">Conta:
                                <a class="name_link" href="{{route('clients.show',$documento->conta)}}">
                                    {{$documento->conta->descricao.' => '.$documento->conta->descricao}}
                                </a>
                            </span>
                        </div><br>
                    </div>
                    <div class="col-md-12">
                        <div><span class="text-secondary ">Observações:</span> {{$documento->observacoes}}</div><br>
                    </div>
                </div>
            @elseif--}}
            <div class="row documento">
                <div class="col-md-4">
                    <label for="nome">Verifique o documento</label><br>
                </div><br><br>
                <div class="col-md-8">
                    <a class="" onclick="window.open('{{Storage::disk('public')->url('client-documents/'.$documento->idCliente .'/'. $documento->imagem)}}', '', 'width=620,height=450,toolbar=no,location=no,menubar=no,copyhistory=no,status=no,directories=no,scrollbars=yes,resizable=yes'); return false;" href="{{Storage::disk('public')->url('client-documents/'.$documento->idCliente .'/'. $documento->imagem)}}" id="yui_3_17_2_1_1589215110643_49">
                        <img src="../../storage/default-photos/pdf.png" class="iconlarge activityicon" alt="" role="presentation" aria-hidden="true">
                        <span class="instancename">Abrir {{$documento->tipo}}</span>
                    </a>
                </div><br><br>
                @if(strtolower($tipo) == "passaport")
                    <div class="col-md-4">
                        <div><span class="text-secondary ">Nº Passaport:</span> {{$documento->numPassaport}}</div><br>
                    </div>
                    <div class="col-md-4">
                        <div><span class="text-secondary ">Data de validade:</span> {{date("m/Y",strtotime($documento->dataValidPP))}}</div><br>
                    </div>
                    <div class="col-md-4">
                        <div><span class="text-secondary ">País de Emissão:</span> {{$documento->passaportPaisEmi}}</div><br>
                    </div>
                    <div class="col-md-4">
                        <div><span class="text-secondary ">Local de Emissão:</span> {{$documento->localEmissaoPP}}</div><br>
                    </div>
                    @php
                        $i=0;
                    @endphp
                    @foreach($infoKeys as $key)
                        @php
                            $i++;
                        @endphp
                        <div class="col-md-4">
                            <div><span class="text-secondary ">{{$key}}:</span> {{$infoDoc[$key]}}</div><br>
                        </div>
                    @endforeach
                @else
                    @if($tipoPAT == "Academico")
                        <div class="col-md-4">
                            <div><span class="text-secondary ">País de Emissão:</span> {{$documento->nome}}</div><br>
                        </div>
                    @else
                        <div class="col-md-4">
                            <div><span class="text-secondary ">Data de validade:</span> {{date("m/Y",strtotime($documento->dataValidade))}}</div><br>
                        </div>
                    @endif
                    @php
                        $i=0;
                    @endphp
                    @foreach($infoKeys as $key)
                        @php
                            $i++;
                        @endphp
                        <div class="col-md-4">
                            <div><span class="text-secondary ">{{$key}}:</span> {{$infoDoc[$key]}}</div><br>
                        </div>
                    @endforeach
                @endif
                <div class="row col-md-12" style="float: right;">
                    <div class="col-md-4">
                        @if($tipoPAT == 'Pessoal')
                            <form method="GET" role="form" action="{{route('documento-pessoal.edit',$documento)}}" class="d-inline-block">
                        @elseif($tipoPAT == 'Academico')
                            <form method="GET" role="form" action="{{route('documento-academico.edit',$documento)}}" class="d-inline-block">
                        @else
                            <form method="GET" role="form" action="{{route('documento-transacao.edit',$documento)}}" class="d-inline-block">
                        @endif
                            @csrf
                            <button type="submit" class="top-button mr-2" title="Verificar Documento">Editar Documento</i></button>
                        </form>
                    </div>

                    <div class="col-md-4">
                        @if($tipoPAT == 'Pessoal')
                            <form method="POST" role="form" action="{{route('documento-pessoal.verifica',$documento)}}" class="d-inline-block">
                        @elseif($tipoPAT == 'Academico')
                            <form method="POST" role="form" action="{{route('documento-academico.verifica',$documento)}}" class="d-inline-block">
                        @else
                            <form method="POST" role="form" action="{{route('documento-transacao.verifica',$documento)}}" class="d-inline-block">
                        @endif
                            @csrf
                            @method('PUT')
                            <button type="submit" class="top-button mr-2" title="Verificar Documento">Aceitar Documento</i></button>
                        </form>
                    </div><br>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>

@section('scripts')
    <script type="text/javascript">
    </script>
@endsection

@endsection
