@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Estudantes')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

<style>
    @media screen and (max-width: 1000px) {

#dataTable th:nth-of-type(4),
#dataTable td:nth-of-type(4) {
    display: none;
}

}
</style>


@endsection


{{-- Conteudo da Página --}}
@section('content')
@include('clients.partials.modal')
<!-- MODAL DE INFORMAÇÔES -->

<div class="container-fluid my-4">

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">

        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Listagem de Estudantes</strong></h4>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                @if (Auth::user()->tipo == "admin")
                <a class="btn btn-sm btn-primary m-1 mr-2" href="{{route('clients.searchIndex')}}"><i
                        class="fas fa-search mr-2"></i>Pesquisa avançada</a>
                <a class="btn btn-sm btn-success m-1" href="{{route('clients.create')}}"><i
                        class="fas fa-plus mr-2"></i>Adicionar Estudante</a>
                @endif
            </div>

        </div>

        <hr>


        {{-- VERIFICA SE EXISTEM CLIENTES --}}
        @if($clients)

        <div class="row">
            <div class="col">
                {{-- Contagem dos clientes ativos ou proponentes --}}
                <span class="text-muted font-weight-bold">Existe {{count($clients)}} registo(s) no sistema.</span>
            </div>

            <div class="col text-right">
                    <span class="p-2 px-3 border bg-light " ><small>
                        <span class="mx-1">{{ $clients->where("estado", "Ativo")->count() }} Ativos</span><span class="mx-1">|</span>
                        <span class="mx-1">{{ $clients->where("estado", "Proponente")->count() }} Proponentes</span><span class="mx-1">|</span>
                        <span class="mx-1">{{ $clients->where("estado", "Inativo")->count() }} Inativos</span>
                    </small>
                    </span>
            </div>
        </div>


        <div class="row mt-3">
            <div class="col">
                {{-- Input de procura nos resultados da dataTable --}}
                <input type="text" class="shadow-sm" id="customSearchBox" placeholder="Procurar nos resultados..."
                    aria-label="Procurar" style="width:100%;">
            </div>
        </div>


        <div class="table-responsive mt-4">
            <table id="dataTable" class="table table-bordered table-hover text-black" style="width:100%">

                {{-- Cabeçalho da tabela --}}
                <thead>
                    <tr>
                        {{--<th class="text-center align-content-center ">Foto</th> --}}
                        <th>Nome</th>
                        <th>N.º Passaporte</th>
                        <th>País</th>
                        <th>Estado</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>

                {{-- Corpo da tabela --}}
                <tbody>

                    @foreach ($clients as $client)

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
                    @endforeach
                </tbody>
            </table>
        </div>


        @else

        <div class="border rounded bg-light p-2 mt-4">
            <span class="text-muted"><small>(sem dados para mostrar)</small></span>
        </div>

        @endif

    </div>
</div>


@endsection

{{-- Utilização de scripts: --}}
@section('scripts')
<script src="{{asset('/js/clients.js')}}"></script>
@endsection
