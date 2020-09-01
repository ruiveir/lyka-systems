@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Pesquisar Base de Dados')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')
@include('clients.partials.modal')


<div class="container-fluid my-4">


    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-2 px-4 pt-4 pb-1 " style="min-width: 565px">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Pesquisa avançada</strong></h4>
                </div>
            </div>
        </div>


        <hr>


        {{-- Formulário de pesquisa --}}

        <form method="POST" id="searchForm" action="{{route('clients.searchResults')}}" class="form-group"
            enctype="multipart/form-data">
            @csrf

            <div class="row mt-3">

                <div class="col col-3" style="min-width:220px">
                    <div class="font-weight-bold">Escolha o campo:</div>
                    <select id="search_options" name="search_options" class="custom-select select_style mt-2">
                        <option value="País de origem" selected>País de origem</option>
                        <option value="Cidade de origem">Cidade de origem</option>
                        <option value="Instituição de origem">Instituição de origem</option>
                        <option value="Agente">Agente</option>
                        <option value="Universidade">Universidade</option>
                        <option value="Nível de estudos">Nível de estudos</option>
                        <option value="Estado de cliente">Estado de cliente</option>
                    </select>

                </div>

                <div class="col" style="min-width: 300px">

                    <div id="searchfields" >

                        {{-- Pesquisa por País de origem --}}
                        <div id="divPaisOrigem">
                            <span class="font-weight-bold">Selecione o País de Origem:</span>
                            <select id="paisNaturalidade" name="paisNaturalidade"
                                class="custom-select select_style mt-2" style="width:100%">
                                @if(!empty($paises) )
                                <option selected hidden>Selecione o País de Origem</option>
                                @foreach ($paises as $pais)
                                <option value="{{$pais}}">{{$pais}}</option>
                                @endforeach
                                @else
                                <option selected hidden value="0">Sem registos</option>
                                @endif
                            </select>
                        </div>


                        {{-- Pesquisa por cidade de origem --}}
                        <div id="divCidade" style="display: none">
                            <span class="font-weight-bold">Selecione a Cidade de Origem:</span>
                            <select id="cidade" name="cidade" class="custom-select select_style mt-2"
                                style="width:100%">
                                @if(!empty($cidadesOrigem) )
                                <option selected hidden>Selecione a cidade de origem</option>
                                @foreach ($cidadesOrigem as $cidade)
                                <option value="{{$cidade}}">{{$cidade}}</option>
                                @endforeach
                                @else
                                <option selected hidden value="0">Sem registos</option>
                                @endif
                            </select>
                        </div>


                        {{-- Pesquisa por Instituição de origem --}}
                        <div id="divInstituicaoOrigem" {{--  style="display: none" --}}>
                            <span class="font-weight-bold">Selecione a Instituição de Origem:</span>
                            <select id="nomeInstituicaoOrigem" name="nomeInstituicaoOrigem"
                                class="custom-select select_style mt-2 " style="width:100%">
                                @if(!empty($instituicoesOrigem) )
                                <option selected hidden>Selecione a Instituição de origem</option>
                                @foreach ($instituicoesOrigem as $instituição)
                                <option value="{{$instituição}}">{{$instituição}}</option>
                                @endforeach
                                @else
                                <option selected hidden value="0">Sem registos</option>
                                @endif
                            </select>
                        </div>


                        {{-- Pesquisa por Agente --}}
                        <div id="divAgents" style="display: none">
                            <span class="font-weight-bold">Selecione o Agente:</span>
                            <select id="agente" name="agente" class="custom-select select_style mt-2"
                                style="width:100%">
                                @if( $agents )
                                <option selected hidden>Selecione o Agente</option>
                                @foreach ($agents as $agent)
                                <option value="{{$agent->idAgente}}">{{$agent->nome}} {{$agent->apelido}}
                                    ({{$agent->pais}})</option>
                                @endforeach
                                @else
                                <option selected hidden value="0">Sem registos</option>
                                @endif
                            </select>
                        </div>

                        {{-- Pesquisa por Universidades --}}
                        <div id="divUniversidades" style="display: none">
                            <span class="font-weight-bold">Selecione a Universidade:</span>
                            <select id="universidade" name="universidade" class="custom-select select_style mt-2"
                                style="width:100%">
                                @if( $universidades )
                                <option selected hidden>Selecione a Universidade</option>
                                @foreach ($universidades as $universidade)
                                <option value="{{$universidade->idUniversidade}}">{{$universidade->nome}}
                                </option>
                                @endforeach
                                @else
                                <option selected hidden value="0">Sem registos</option>
                                @endif
                            </select>
                        </div>


                        {{-- Pesquisa por Nivel de estudos --}}
                        <div id="divNivelEstudos" style="display: none">
                            <span class="font-weight-bold">Selecione o Nível de Estudos:</span>
                            <select id="nivelEstudos" name="nivelEstudos" class="custom-select select_style mt-2"
                                style="width:100%">
                                <option value="0" value="0" selected hidden>Selecione Nível de Estudos</option>
                                <option value="Secundário Incompleto">Secundário Incompleto</option>
                                <option value="Secundário Completo">Secundário Completo</option>
                                <option value="Curso Tecnológico">Curso Tecnológico</option>
                                <option value="Estuda na Universidade">Estuda na Universidade</option>
                                <option value="Licenciado">Licenciado</option>
                                <option value="Mestrado">Mestrado</option>
                            </select>
                        </div>


                        {{-- Pesquisa Estado de cliente --}}
                        <div id="divEstadoCliente" style="display: none">
                            <span class="font-weight-bold">Selecione o estado do cliente:</span>
                            <select id="estado" name="estado" class="custom-select select_style mt-2"
                                style="width:100%">
                                <option hidden value="0">Selecione o Estado do Cliente</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                                <option value="Proponente">Proponente</option>
                            </select>
                        </div>

                    </div>

                </div>


                <div class="col p-3" style="min-width: 100px">
                    <div class="mt-3">
                        <button type="submit" class="btn btn-sm btn-primary mr-2 px-3"><i class="fas fa-search mr-2"></i>Pesquisar</button>
                    </div>
                </div>

            </div>

            @if ( isset($clients) )
                @if ( !$clients )
                    <div class="row mt-3">
                        <div class="col p-3 mx-4">
                            <div class="alert alert-primary" role="alert">
                                A pesquisa de estudantes por "<strong>{{$valor}}</strong>" no campo
                                "<strong>{{$nomeCampo}}</strong>" não encontrou nenhum registo no sistema
                              </div>
                            <div ></div>
                        </div>
                    </div>
                @else
                    <div class="row mt-3">
                        <div class="col">
                            <div class="alert alert-primary" role="alert">
                                A pesquisa de estudantes por "<strong>{{$valor}}</strong>" no campo
                                    "<strong>{{$nomeCampo}}</strong>" encontrou <strong>{{count($clients)}}</strong> registo(s) no sistema
                              </div>
                        </div>
                    </div>
                @endif
            @endif
        </form>
    {{-- </div>
 --}}




    @if ( isset($clients) )

    {{-- <div class="bg-white shadow-sm mt-3 mb-4 p-4 "> --}}

        @if ( $clients )

        <div class="row">
            <div class="col ">

                <div class="row " >
                    {{-- procura nos resultados --}}
                    <div class="col">
                        {{-- <div><strong>Pesquisar nos resultados:</strong></div> --}}
                        <div class="align-middle">
                            <input type="text" class="shadow-sm" style="width:100%" id="customSearchBox" placeholder="Procurar nos resultados..." aria-label="Procurar" >
                        </div>
                    </div>

                    <div class="col">
                        {{-- CheckBox: campos disponiveis --}}
                        <div id="grpChkBox" class="pt-2">
                            {{-- <div class="mb-2"><strong>Filtros:</strong></div> --}}
                                {{-- numPassaporte paisNaturalidade cidade nomeInstituicaoOrigem nivEstudoAtual estado --}}
                            <label class="checkbox-inline mx-2"><input type="checkbox" checked name="check_numPassaporte"
                                class="mr-1">N.º Passaporte</label>
                        <label class="checkbox-inline mx-2"><input type="checkbox" checked name="check_paisNaturalidade"
                                class="mr-1">País</label>
                        <label class="checkbox-inline mx-2"><input type="checkbox" name="check_cidade"
                                class="mr-1">Cidade</label>
                        <label class="checkbox-inline mx-2"><input type="checkbox" name="check_nomeInstituicaoOrigem"
                                class="mr-1">Instituicão de Origem</label>
                        <label class="checkbox-inline mx-2"><input type="checkbox" name="check_nivEstudoAtual"
                                class="mr-1">Nível de Estudos</label>
                        <label class="checkbox-inline mx-2"><input type="checkbox" checked name="check_Estado"
                                class="mr-1">Estado</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-3 mb-3">
            <table id="dataTable" class="table table-bordered table-hover " style="width:100%">

                {{-- Cabeçalho da tabela --}}
                <thead>
                    <tr>
                        {{-- numPassaporte paisNaturalidade cidade nomeInstituicaoOrigem nivEstudoAtual estado --}}

                        <th>Nome</th>
                        <th class="check_numPassaporte">N.º Passaporte</th>
                        <th class="check_paisNaturalidade">País</th>
                        <th class="check_cidade" style="display: none">Cidade</th>
                        <th class="check_nomeInstituicaoOrigem" style="display: none">Instituição</th>
                        <th class="check_nivEstudoAtual" style="display: none">Nív.Estudos</th>
                        <th class="check_Estado">Estado</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>

                {{-- Corpo da tabela --}}
                <tbody>

                    @foreach ($clients as $client)
                    <tr>
                        {{-- <td>
                            <div class="align-middle mx-auto shadow-sm rounded bg-white"
                                style="overflow:hidden; width:50px; height:50px">
                                <a class="name_link" href="{{route('clients.show',$client)}}">
                                    @if($client->fotografia)
                                    <img src="{{url('/storage/client-documents/'.$client->idCliente.'/').$client->fotografia}}"
                                        width="100%" class="mx-auto">
                                    @elseif($client->genero == 'F')
                                    <img src="{{url('/storage/default-photos/F.jpg')}}" width="100%"
                                        class="mx-auto">
                                    @else
                                    <img src="{{url('/storage/default-photos/M.jpg')}}" width="100%"
                                        class="mx-auto">
                                    @endif
                                </a>
                            </div>

                        </td> --}}

                        {{-- Nome e Apelido --}}
                        <td class="align-middle"><a href="{{route('clients.show',$client)}}">{{ $client->nome }}
                                {{ $client->apelido }}</a>
                        </td>

                        {{-- numPassaporte --}}
                        <td class="align-middle check_numPassaporte">{{ $client->numPassaporte }}</td>

                        {{-- paisNaturalidade --}}
                        <td class="align-middle check_paisNaturalidade">{{ $client->paisNaturalidade }}</td>

                        {{-- cidade --}}
                        <td class="align-middle check_cidade" style="display: none">{{ $client->cidade }}</td>

                        {{-- nomeInstituicaoOrigem --}}
                        <td class="align-middle check_nomeInstituicaoOrigem" style="display: none">
                            {{ $client->nomeInstituicaoOrigem }}</td>

                        {{-- nivEstudoAtual --}}
                        <td class="align-middle check_nivEstudoAtual" style="display: none">
                            {{ $client->nivEstudoAtual }}</td>

                        {{-- Estado de cliente --}}
                        <td class="align-middle check_Estado">

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

                            <a href="{{route('clients.show',$client)}}" class="btn btn-sm btn-outline-primary"
                                title="Ver ficha completa"><i class="far fa-eye"></i></a>


                            {{-- Permissões para editar --}}

                            <a href="{{route('clients.edit',$client)}}" class="btn btn-sm btn-outline-warning"
                                title="Editar"><i class="fas fa-pencil-alt"></i></a>

                            <form method="POST" role="form" id="{{ $client->idCliente }}"
                                action="{{route('clients.destroy',$client)}}"
                                data="{{ $client->nome }} {{ $client->apelido }}" class="d-inline-block form_client_id">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar estudante" data-toggle="modal"
                                    data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                            </form>


                        </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>
        @endif


    </div>

    @endif {{-- ( if isset clientes ) --}}

</div>

@endsection

{{-- Scripts --}}
@section('scripts')

{{-- script contem: datatable configs, input configs, validações --}}
<script src="{{asset('/js/client_search.js')}}"></script>

{{-- script permite definir se um input recebe só numeros OU so letras --}}

@endsection
