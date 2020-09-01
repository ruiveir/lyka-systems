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
        <div class="row">
            <div class="col-md-4 title">
                <h1 class="h4 mb-0 text-gray-800">Informação do {{$tipo}}</h1>
            </div>
            <div class="col-md-8">
                <a class="" onclick="window.open('{{url('/storage/client-documents/'.$documento->idCliente .'/'. $documento->imagem)}}', '', 'width=620,height=450,toolbar=no,location=no,menubar=no,copyhistory=no,status=no,directories=no,scrollbars=yes,resizable=yes'); return false;" href="{{url('/storage/client-documents/'.$documento->idCliente .'/'. $documento->imagem)}}" id="yui_3_17_2_1_1589215110643_49">
                    <img src="../../storage/default-photos/pdf.png" class="iconlarge activityicon" alt="" role="presentation" aria-hidden="true">
                    <span class="instancename">Abrir Imagem do {{$documento->tipo}}</span>
                </a>
            </div><br><br>
        </div>
        <br>
        <div class="formulario-edicao shadow-sm">
            <div class="row documento">
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
            </div>
            <div class="text-right">
                @if($tipoPAT == 'Pessoal')
                    <a href="{{route('documento-pessoal.edit', $documento)}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
                        <span class="icon text-white-50">
                            <i class="fas fa-pencil-alt"></i>
                        </span>
                        <span class="text">Editar Documento</span>
                    </a>
                @elseif($tipoPAT == 'Academico')
                    <a href="{{route('documento-academico.edit', $documento)}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
                        <span class="icon text-white-50">
                            <i class="fas fa-pencil-alt"></i>
                        </span>
                        <span class="text">Editar Documento</span>
                    </a>
                @else
                    <a href="{{route('documento-transacao.edit', $documento)}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
                        <span class="icon text-white-50">
                            <i class="fas fa-pencil-alt"></i>
                        </span>
                        <span class="text">Editar Documento</span>
                    </a>
                @endif
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
