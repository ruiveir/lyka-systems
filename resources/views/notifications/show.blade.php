@extends('layout.master')
<!-- Page Title -->
@section('title', 'Notifificacao')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Notificação</h1>
    </div>
    <!-- Approach -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Visualização - Notificação</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <p class="text-gray-800"><b>Tipo:</b>
                        @if($notification->type == "App\Notifications\Aniversario")
                            Aniversario
                        @elseif($notification->type == "App\Notifications\Atraso")
                            Atraso
                        @elseif($notification->type == 'App\Notifications\AtrasoCliente')
                            AtrasoCliente
                        @else
                            Abertura
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="text-gray-800"><b>Assunto:</b> {{$notification->data['assunto']}}</p>
                </div>
                <div class="col-md-3">
                    <p class="text-gray-800"><b>Urgente:</b> @if($notification->data['urgencia'])Sim @else Não @endif</p>
                </div>
                <br>
                <br>
                <br>
                <br>
            </div>
            @if($notification->type == "App\Notifications\Aniversario")
                @php
                    $descricoes = explode('*',str_replace(array("\\r\\n", "\\r", "\\n"), "*", $notification->data['descricao']));
                @endphp
                Descrição
                @foreach($descricoes as $descricao)
                    {{$descricao}}
                    <br>
                @endforeach
            @elseif($notification->type == "App\Notifications\Atraso" || $notification->type == 'App\Notifications\AtrasoCliente')
                @php
                    $descricoes = explode('*',str_replace(array("\\r\\n", "\\r", "\\n"), "*", $notification->data['descricao']));
                    $idCliente = explode('_',$notification->data['code']);
                    $num = 2;
                    $primeiraDescricao = true;
                @endphp
                Clientes com Atraso
                <div class="table-responsive mt-4">
                    <table id="dataTable" class="table table-bordered table-hover text-black" style="width:100%">
        
                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>
                                {{--<th class="text-center align-content-center ">Foto</th> --}}
                                <th>Nome</th>
                                <th>N.º Passaporte</th>
                                <th>País</th>
                                <th>Urgente</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>
        
                        {{-- Corpo da tabela --}}
                        <tbody>
        
                            @foreach($clientesNotificacao as $client)
                                @if($client->idCliente == $idCliente[$num])
            
                                    @if ( $client->estado=="Ativo" || $client->estado=="Proponente")
                                    <tr>
                                        {{-- Só mostras os clientes ativos ou proponentes --}}
                
                
                                        {{-- Nome e Apelido --}}
                                        <td class="align-middle"><a class="name_link"
                                                href="{{route('clients.show',$client)}}">{{ $client->nome }}
                                                {{ $client->apelido }}</a>
                                        </td>
                
                                        {{-- numPassaporte --}}
                                        <td class="align-middle">{{ $client->numPassaporte }}</td>
                
                                        {{-- País de origem --}}
                                        <td class="align-middle">{{ $client->paisNaturalidade }}</td>
                
                                        {{-- Estado de cliente --}}
                                        <td class="align-middle">
                
                                            @if ( $client->estado == "Ativo")
                                            <span class="text-success">Ativo</span>
                                            @elseif( $client->estado == "Inativo")
                                            <span class="text-danger">Inativo</span>
                                            @else
                                            <span class="text-info">Proponente</span>
                                            @endif
                
                                        </td>
                
                
                                        {{-- OPÇÔES --}}
                                        <td class="text-center align-middle">
                
                                            {{-- Opção: Ver detalhes --}}
                                            <a href="{{route('clients.show',$client)}}" class="btn btn-sm btn-outline-primary"
                                                title="Ver ficha completa"><i class="far fa-eye"></i></a>
                
                                            {{-- Permissões para editar --}}
                                            @if (Auth::user()->tipo == "admin" || Auth::user()->tipo == "agente" && $client->editavel ==
                                            1)
                                            <a href="{{route('clients.edit',$client)}}" class="btn btn-sm btn-outline-warning"
                                                title="Editar"><i class="fas fa-pencil-alt"></i>
                                            </a>
                                            @endif
                
                
                                            {{-- Opção APAGAR --}}
                                            @if (Auth::user()->tipo == "admin")
                                            <form method="POST" role="form" id="{{ $client->idCliente }}"
                                                action="{{route('clients.destroy',$client)}}"
                                                data="{{ $client->nome }} {{ $client->apelido }}" class="d-inline-block form_client_id">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar estudante"
                                                    data-toggle="modal" data-target="#deleteModal"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                            @endif
                
                                        </td>
                                    </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{--@foreach($descricoes as $descricao)
                    @if($primeiraDescricao)
                        {{$descricao}}
                        @php
                            $primeiraDescricao = false;
                        @endphp
                    @else
                        @foreach($clientesNotificacao as $cliente)
                            @if($cliente->idCliente == $idCliente[$num])
                                <a class="dropdown-item d-flex align-items-center" href="{{route("clients.show", $cliente)}}">
                                    {{$descricao}}
                                </a>
                            @endif
                        @endforeach
                        @php
                            $num++;
                        @endphp
                    @endif
                    <br>
                @endforeach--}}
            @else
                Descrição
            @endif
        </div>
    </div>
</div>

@endsection
<!-- End of Page Content -->
