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

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Notificações</h1>
    </div>
    <!-- Approach -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                @if($notifications)
                    @if(count($notifications)==1)
                        Existe {{count($notifications)}} notificação existente
                    @else
                        Existe {{count($notifications)}} notificações existentes
                    @endif
                @endif
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive p-1">
                @if($notifications)
                <table class="table table-bordered table-striped" id="table" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Tipo</th>
                            <th>Assunto</th>
                            <th style="max-width:100px; min-width:100px;">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                        <tr>
                            <td>
                                <div class="align-middle mx-auto rounded bg-white" style="overflow:hidden;">
                                    @if($notification->type == "App\Notifications\BugReportSend")
                                        <div class="icon-circle bg-danger">
                                            <i class="fas fa-bug text-white"></i>
                                        </div>
                                    @elseif($notification->type == "App\Notifications\Aniversario")
                                        <div class="icon-circle bg-gradient-primary text-white">
                                            <i class="fa fa-birthday-cake"></i>
                                        </div>
                                    @elseif(($notification->type == "App\Notifications\Atraso" || $notification->type == 'App\Notifications\AtrasoCliente') 
                                        && $notification->data['urgencia'])
                                        <div class="icon-circle bg-gradient-danger text-white">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                    @elseif(($notification->type == "App\Notifications\Atraso" || $notification->type == 'App\Notifications\AtrasoCliente')
                                        && !$notification->data['urgencia'])
                                        <div class="icon-circle bg-gradient-warning text-white">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                    @else
                                        <div class="icon-circle bg-gradient-success text-white">
                                            <i class="fas fa-bug"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                                
                            <td>
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
                            <td>
                                @if($notification->type == "App\Notifications\BugReportSend")
                                    {{$notification->data["subject"]}}
                                @else
                                    {{$notification->data["assunto"]}}
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                @if($notification->type == "App\Notifications\BugReportSend")
                                <a href="{{route("bugreport.show", $notification->data["idReport"])}}" class="btn btn-sm btn-outline-primary" title="Ficha completa"><i class="far fa-eye"></i></a>
                                @else
                                <a href="{{route('notification.show',$notification)}}" class="btn btn-sm btn-outline-primary" title="Ficha completa"><i class="far fa-eye"></i></a>
                                @endif
                                @if($notification->type == "App\Notifications\Aniversario")
                                <button onclick="{{$notification->delete()}}" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="border rounded bg-light p-2 mt-4" >
                        <span class="text-muted"><small>(sem notificações)</small></span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>







@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/contacts.js')}}"></script>

@endsection
