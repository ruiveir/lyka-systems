@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Notificações')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">


@endsection


{{-- Conteudo da Página --}}
@section('content')


<div class="container-fluid my-4">
    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Notificações</strong></h4>
                </div>
            </div>

        </div>

        <hr>

        <div class="row my-2">
            <div class="col">
                @if($notifications)
                    @if(count($notifications)==1)
                        <div class="text-secondary"><strong>Existe {{count($notifications)}} notificação existente</strong></div>
                    @else
                        <div class="text-secondary"><strong>Existe {{count($notifications)}} notificações existentes</strong></div>
                    @endif
                @endif
            </div>
        </div>


        <div class="row mt-4">


            @if($notifications)

            <div class="col">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover " style="width:100%">

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>

                                <th class="text-center align-content-center "></th>

                                <th>Tipo</th>
                                <th>Assunto</th>
                                {{--<th>Descrição</th>--}}
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>

                        {{-- Corpo da tabela --}}
                        <tbody>
                            @foreach ($notifications as $notification)
                            <tr>
                                    <td>
                                        @if($notification->type == "App\Notifications\BugReportSend")
                                            <a class="name_link" href="{{route("bugreport.show", $notification->data["idReport"])}}">
                                        @else
                                            <a class="name_link" href="{{route('notification.show',$notification)}}">
                                        @endif
                                        <div class="align-middle mx-auto shadow-sm rounded bg-white"
                                            style="overflow:hidden; width:50px; height:50px">
                                            @if($notification->type == "App\Notifications\BugReportSend")
                                                <div class="icon-circle bg-danger">
                                                    <i class="fas fa-bug text-white"></i>
                                                </div>
                                            @elseif($notification->type == "App\Notifications\Aniversario")
                                                <div class="icon-circle bg-danger">
                                                    <i class="fa fa-birthday-cake text-white" style="color:rgb(0, 132, 255)"></i>
                                                </div>
                                            @elseif(($notification->type == "App\Notifications\Atraso" || $notification->type == 'App\Notifications\AtrasoCliente') 
                                                && $notification->data['urgencia'])
                                                <div class="icon-circle bg-danger">
                                                    <i class="fas fa-exclamation-triangle text-white" style="color:rgba(255, 0, 0, 0.507)"></i>
                                                </div>
                                            @elseif(($notification->type == "App\Notifications\Atraso" || $notification->type == 'App\Notifications\AtrasoCliente')
                                                && !$notification->data['urgencia'])
                                                <div class="icon-circle bg-danger">
                                                    <i class="fas fa-exclamation-triangle text-white" style="color:rgb(255, 115, 0)"></i>
                                                </div>
                                            @else
                                                <div class="icon-circle bg-danger">
                                                    <i class="fas fa-bug text-white" style="color:rgb(94, 255, 0)"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </a>

                                    </td>

                                    {{-- tipo --}}
                                    <td class="align-middle">
                                        @if($notification->type == "App\Notifications\BugReportSend")
                                            <a class="name_link" href="{{route("bugreport.show", $notification->data["idReport"])}}">
                                        @else
                                            <a class="name_link" href="{{route('notification.show',$notification)}}">
                                        @endif
                                        @if($notification->type == "App\Notifications\BugReportSend")
                                            <span>BugReportSend</span>
                                        @elseif($notification->type == "App\Notifications\Aniversario")
                                            <span>Aniversario</span>
                                        @elseif($notification->type == "App\Notifications\Atraso")
                                            <span>Atraso<span>
                                        @elseif($notification->type == 'App\Notifications\AtrasoCliente')
                                            <span>AtrasoCliente</span>
                                        @else
                                            <span>Abertura</span>
                                        @endif
                                        </a>
                                    </td>

                                    {{-- Assunto --}}
                                    <td class="align-middle">
                                        @if($notification->type == "App\Notifications\BugReportSend")
                                            <a class="name_link" href="{{route("bugreport.show", $notification->data["idReport"])}}">
                                        @else
                                            <a class="name_link" href="{{route('notification.show',$notification)}}">
                                        @endif
                                        @if($notification->type == "App\Notifications\BugReportSend")
                                            {{$notification->data["subject"]}}
                                        @else
                                            {{$notification->data["assunto"]}}
                                        @endif
                                        </a>
                                    </td>
                                    
                                    {{-- Descrição --}}
                                    {{--<td class="align-middle">
                                        @if($notification->type == "App\Notifications\BugReportSend")
                                            <a class="name_link" href="{{route("bugreport.show", $notification->data["idReport"])}}">
                                        @else
                                            <a class="name_link" href="{{route('notification.show',$notification)}}">
                                        @endif
                                        @if($notification->type == "App\Notifications\BugReportSend")
                                            @foreach($relatorios as $relatorio)
                                                @if($relatorio->idRelatorioProblema == $notification->data["idReport"])
                                                    {{$relatorio->relatorio}}
                                                @endif
                                            @endforeach
                                        @else
                                            {{$notification->data["descricao"]}}
                                        @endif
                                        </a>
                                    </td>


                                    {{-- OPÇÔES --}}
                                    <td class="text-center align-middle">
                                        @if($notification->type == "App\Notifications\BugReportSend")
                                            <a href="{{route("bugreport.show", $notification->data["idReport"])}}" class="btn btn-sm btn-outline-primary "
                                                title="Ver ficha completa"><i class="far fa-eye"></i></a>
                                        @else
                                            <a href="{{route('notification.show',$notification)}}" class="btn btn-sm btn-outline-primary "
                                                title="Ver ficha completa"><i class="far fa-eye"></i></a>
                                        @endif

                                        @if($notification->type == "App\Notifications\Aniversario")
                                            <a href="#" onclick="{{$notification->delete()}}"><i class="fas fa-trash-alt"></i></a>
                                        @endif
                                    </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

                @else

                <div class="border rounded bg-light p-2 mt-4" >
                    <span class="text-muted"><small>(sem notificações)</small></span>
                </div>

                @endif
            </div>

            </div>
        </div>
    </div>
</div>









@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/contacts.js')}}"></script>

@endsection
