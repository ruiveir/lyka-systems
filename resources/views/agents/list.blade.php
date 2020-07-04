@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Agentes')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

@endsection


{{-- Conteudo da Página --}}
@section('content')
@include('agents.partials.modal')
<!-- MODAL DE INFORMAÇÔES -->



<div class="container-fluid my-4">

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Listagem de @if (Auth::user()->tipo == "agente")
                            {{-- se for agente --}}
                            Sub agentes
                            @else
                            {{-- se for admin --}}
                            Agentes
                            @endif</strong>
                    </h4>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                <a href="{{route('agents.create')}}" class="btn btn-sm btn-success px-3"><i
                        class="fas fa-plus mr-2"></i>Adicionar Agente</a>
            </div>

        </div>

        <hr>

        @if($agents)

        <div class="row">
            <div class="col">
                {{-- Contagem dos Agentes --}}
                <span class="text-muted font-weight-bold">Existe {{count($agents)}} registo(s) no sistema</span>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
            {{-- Input de procura nos resultados da dataTable --}}
            <input type="text" class="shadow-sm" id="customSearchBox" placeholder="Procurar nos resultados..."
                aria-label="Procurar" style="width:100%;">
            </div>
        </div>


        <div class="row mt-4">

            <div class="col">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover " style="width:100%">

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>
                                <th class="text-center align-content-center ">Foto</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                {{-- <th>E-mail</th> --}}
                                <th>País</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>

                        {{-- Corpo da tabela --}}
                        <tbody>

                            @foreach ($agents as $agent)
                            <tr>
                                <td>
                                    <div class="align-middle mx-auto shadow-sm rounded  bg-white"
                                        style="overflow:hidden; width:50px; height:50px">
                                        <a class="name_link" href="{{route('agents.show',$agent)}}">
                                            @if($agent->fotografia)
                                            <img src="{{Storage::disk('public')->url('agent-documents/'.$agent->idAgente.'/').$agent->fotografia}}"
                                                width="100%" class="mx-auto">
                                            @elseif($agent->genero == 'F')
                                            <img src="{{Storage::disk('public')->url('default-photos/F.jpg')}}"
                                                width="100%" class="mx-auto">
                                            @else
                                            <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}"
                                                width="100%" class="mx-auto">
                                            @endif
                                        </a>
                                    </div>

                                </td>

                                {{-- Nome e Apelido --}}
                                <td class="align-middle"><a class="name_link"
                                        href="{{route('agents.show',$agent)}}">{{ $agent->nome }}
                                        {{ $agent->apelido }}</a>
                                </td>

                                {{-- Tipo --}}
                                <td class="align-middle">{{ $agent->tipo }}</td>

                                {{-- e-mail --}}
                                {{-- <td class="align-middle">{{ $agent->email }}</td> --}}

                                {{-- País --}}
                                <td class="align-middle">{{ $agent->pais }}</td>


                                {{-- OPÇÔES --}}
                                <td class="text-center align-middle">
                                    <a href="{{route('agents.show',$agent)}}" class="btn btn-sm btn-outline-primary"
                                        title="Ver ficha completa"><i class="far fa-eye"></i></a>


                                    <a href="{{route('agents.edit',$agent)}}" class="btn btn-sm btn-outline-warning"
                                        title="Editar"><i class="fas fa-pencil-alt"></i></a>

                                    <form method="POST" role="form" id="{{ $agent->idAgente }}"
                                        action="{{route('agents.destroy',$agent)}}"
                                        data="{{ $agent->nome }} {{ $agent->apelido }}"
                                        class="d-inline-block form_agent_id">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar agente"
                                            data-toggle="modal" data-target="#deleteModal"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>


            @else
                <div class="border rounded bg-light p-3 text-muted"><small>(sem registos)</small></div>
            @endif

        </div>

    </div>



    @endsection

    {{-- Utilização de scripts: --}}
    @section('scripts')

    <script src="{{asset('/js/agent.js')}}"></script>

    @endsection
