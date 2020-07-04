@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'TITULO DA PÁGINA')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

@endsection


{{-- Conteudo da Página --}}
@section('content')


<!-- MODAL DE Confirmação de eleminação de registo -->
{{-- @include('area.partials.modal') --}}


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

    <div class="float-right">
        {{-- Botão para administradores --}}
        {{-- @if (Auth::user()->tipo == "admin") --}}
        {{-- <a href="{{route('agents.create')}}" class="top-button">Adicionar Qualquer Coisa</a> --}}
        {{-- @endif --}}
    </div>

    <br><br>


    <div class="cards-navigation">
        <div class="title">
            <h6>Listagem de Items</h6>
        </div>

        <br>

        <div class="bg-white shadow-sm mb-4 p-4 " style="border-radius:10px;">


            {{-- Condição caso o resultado da query seja nullo --}}

            @if($variavel==null)

                {{-- Mensagem de informação --}}
                <div class="border rounded bg-light p-3 text-muted"><small>(sem registos)</small></div>

            @else

                <div class="row mx-1">

                    <div class="col col-2" style="max-width: 120px">
                        {{-- ICON DA AREA --}}
                        <i class="fas fa-user-tie active" style="font-size:80px"></i>
                    </div>

                    <div class="col">
                        {{-- Contagem de registos devolvidos pela query --}}
                        <div class="text-secondary"><strong>Existe {{$NOME_VARIAVEL??}} registo(s) no sistema</strong></div>

                        <br>

                        {{-- Input de procura nos resultados da dataTable --}}
                        <div style="width: 100%; border-radius:10px;">
                            <input type="text" class="shadow-sm" id="customSearchBox" placeholder="Procurar nos resultados..." aria-label="Procurar">
                        </div>
                    </div>

                </div>


                <br>


                {{-- Tabela responsiva DATATABLES --}}
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover " style="width:100%">

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Campo1</th>
                                <th>Campo2</th>
                                <th>Campo3</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>


                        {{-- Corpo da tabela --}}
                        <tbody>

                            {{-- Construção da lista com os registos da query --}}
                            @foreach ($variaveis as $variavel)
                            <tr>

                                {{-- Fotografia --}}
                                <td>
                                    <div class="align-middle mx-auto shadow-sm rounded  bg-white" style="overflow:hidden; width:50px; height:50px">

                                        <a class="name_link" href="#{{-- {{route('pagina.show',$variavel)}} --}}">
                                            @if($variavel->fotografia)
                                                <img src="{{Storage::disk('public')->url('area-documents/'.$variavel->atributo.'/').$variavel->fotografia}}" width="100%" class="mx-auto">
                                            @elseif($variavel->genero == 'F')
                                                <img src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" width="100%" class="mx-auto">
                                            @else
                                                <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                                            @endif
                                        </a>
                                    </div>
                                </td>

                                {{-- Campo1 --}}
                                <td><a class="name_link"  href="#{{-- {{route('pagina.show',$variavel)}} --}}">{{ $variavel->atributo ?? }}</a> </td>

                                {{-- Campo2 --}}
                                <td>{{ $variavel->atributo ?? }}</td>

                                {{-- Campo3 --}}
                                <td>{{ $variavel->atributo ??}}</td>


                                {{-- OPÇÔES --}}
                                <td class="text-center align-middle">

                                    {{-- Pagina de SHOW --}}
                                    <a href="{{route('area.show',$variavel)}}" class="btn_list_opt " title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>

                                    {{-- Pagina de EDIT --}}
                                    <a href="{{route('area.edit',$variavel)}}" class="btn_list_opt btn_list_opt_edit" title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>


                                    {{-- OPÇÃO DE APAGAR REGISTO --}}
                                    <form method="POST" role="form" id="{{ $variavel->id ?? }}" action="#{{-- {{route('controlador.destroy',$variavel)}} --}}"
                                        data="{{ $variavel->atributo }}" class="d-inline-block CLASS_PARA_ID_NO_Jquery(ex:form_agent_id) ">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn_list_opt btn_delete" title="Eliminar registo" data-toggle="modal" data-target="{{-- nome da modal --}}#deleteModal">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>


            @endif

        </div>

    </div>
</div>
@endsection





{{-- Utilização de scripts: --}}
@section('scripts')

{{-- <script src="{{asset('/js/nome_do_ficheiro.js')}}"></script> --}}

@endsection
