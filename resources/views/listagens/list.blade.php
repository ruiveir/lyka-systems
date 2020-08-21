@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem')

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
            <h3>Listagem:</h3>
            <div class="row">
                <div class="col-md-3">
                    <label for="pais">País:</label><br>
                    <select id="pais" class="form-control" onChange="GetCountries()">
                        <option value="null" selected="" hidden="">Selecione país</option>
                        <option value="null">Todos</option>
                        @if($paises)
                            @foreach($paises as $pais)
                                <option value="{{$pais}}">{{$pais}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cidade">Cidade:</label><br>
                    <select id="cidade" class="form-control butCity" onChange="GetList()" readonly>
                        <option value="null" selected="" hidden="">Selecione cidade</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="agente">Agente:</label><br>
                    <select id="agente" class="form-control" onChange="GetList()">
                        <option value="null" selected="" hidden="">Selecione agente</option>
                        <option value="null">Todos</option>
                        @if($agentes)
                            @foreach($agentes as $agente)
                                <option value="{{$agente->idAgente}}">{{$agente->nome.' '.$agente->apelido.' => '.$agente->email}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="subagente">Descrição:</label><br>
                    <select id="subagente" class="form-control"  onChange="GetList()">
                        <option value="null" selected="" hidden="">Selecione subagente</option>
                        <option value="null">Todos</option>
                        @if($subagentes)
                            @foreach($subagentes as $subagente)
                                <option value="{{$subagente->idAgente}}">{{$subagente->nome.' '.$subagente->apelido.' => '.$subagente->email}}</option>
                            @endforeach
                        @endif
                    </select>
                </div><br><br><br><br>
                <div class="col-md-3">
                    <label for="universidade">Descrição:</label><br>
                    <select id="universidade" class="form-control" onChange="GetList()">
                        <option value="null" selected="" hidden="">Selecione universidade</option>
                        <option value="null">Todos</option>
                        @if($universidades)
                            @foreach($universidades as $universidade)
                                <option value="{{$universidade->idUniversidade}}">{{$universidade->nome.' -> '.$universidade->email}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="curso">Descrição:</label><br>
                    <select id="curso" class="form-control" onChange="GetList()">
                        <option value="null" selected="" hidden="">Selecione tipo de curso</option>
                        <option value="null">Todos</option>
                        @if($cursos)
                            @foreach($cursos as $curso)
                                <option value="{{$curso}}">{{$curso}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="institutoOrigem">Instituto origem:</label><br>
                    <select id="institutoOrigem" class="form-control" onChange="GetList()">
                        <option value="null" selected="" hidden="">Selecione instituto origem</option>
                        <option value="null">Todos</option>
                        @if($institutos)
                            @foreach($institutos as $instituto)
                                <option value="{{$instituto}}">{{$instituto}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="atividade">Atividade:</label><br>
                    <select id="atividade" class="form-control" onChange="GetList()">
                        <option value="null" selected="" hidden="">Selecione atividade</option>
                        <option value="null">Todos</option>
                        <option value="Ativo">Ativo</option>
                        <option value="Proponente">Proponente</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>
            </div>
            <br>
            <br>
        </div>

        <div class="lista">
            <table id="dataTable" class="table table-bordered table-hover text-black" style="width:100%">
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
                <tbody id="table-body">
                    <tr id="clonar">
                        {{-- Só mostras os clientes ativos ou proponentes --}}
                        {{-- Nome e Apelido --}}
                        <td class="align-middle">
                            <a class="routa-show name_link" href="#"></a>
                        </td>

                        {{-- numPassaporte --}}
                        <td class="numPassaporte align-middle"></td>

                        {{-- País de origem --}}
                        <td class="paisNaturalidade align-middle"></td>

                        {{-- Estado de cliente --}}
                        <td class="align-middle">
                            <span class="span-estado"></span>
                        </td>


                        {{-- OPÇÔES --}}
                        <td class="text-center align-middle">

                            {{-- Opção: Ver detalhes --}}
                            <a href="#" class="butao-show btn btn-sm btn-outline-primary"
                                title="Ver ficha completa"><i class="far fa-eye"></i></a>


                        </td>
                    </tr>
                    @foreach ($clientes as $cliente)
                    <tr>
                        {{-- Só mostras os clientes ativos ou proponentes --}}
                        {{-- Nome e Apelido --}}
                        <td class="align-middle">
                            <a class="routa-show name_link" href="{{route('clients.show',$cliente)}}">{{$cliente->nome ." ". $cliente->apelido}}</a>
                        </td>

                        {{-- numPassaporte --}}
                        <td class="numPassaporte align-middle">{{$cliente->numPassaporte}}</td>

                        {{-- País de origem --}}
                        <td class="paisNaturalidade align-middle">{{$cliente->paisNaturalidade}}</td>

                        {{-- Estado de cliente --}}
                        <td class="align-middle">
                            <span class="span-estado">{{$cliente->estado}}</span>
                        </td>


                        {{-- OPÇÔES --}}
                        <td class="text-center align-middle">

                            {{-- Opção: Ver detalhes --}}
                            <a href="{{route('clients.show',$cliente)}}" class="butao-show btn btn-sm btn-outline-primary"
                                title="Ver ficha completa"><i class="far fa-eye"></i></a>


                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <option value="null" id="clonecity"></option>


    @section('scripts')
        <script type="text/javascript">
            var clone = $('#clonar').clone();
            $('#clonar').remove();
            var clonecity = $('#clonecity').clone();
            $('#clonecity').remove();

            function GetCountries(){

                GetList();
                $('.butCity').children('option:not(:first)').remove();
                var pais = null;
                
                if($('#pais').val() != "null"){
                    pais = $('#pais').val();
                }
                if(pais){
                    $('.butCity').attr("readonly", false);
                    var link = '/../api/listagem/cidades/'+pais;
                    $.ajax({
                        method:"GET",
                        url:link
                    })
                    .done(function(response){
                        if(response != null){
                            for (i=0; i<response.results.length; i++) {
                                var CloneCidade = clonecity.clone();
                                $(CloneCidade).text(response.results[i]);
                                $(CloneCidade).attr(response.results[i]);
                                $('.butCity').append(CloneCidade);
                            }
                        }
                    })
                }else{
                    $('.butCity').attr("readonly", true);
                }
            }

            function GetList(){
                $('#table-body').html("");

                var lista = null;

                if($('#pais').val() != "null"){
                    lista = "pais-"+$('#pais').val();
                }else{
                    lista = "pais-null";
                }

                if($('#cidade').val() != "null"){
                    lista += "_cidade-"+$('#cidade').val();
                }else{
                    lista += "_cidade-null";
                }

                if($('#agente').val() != "null"){
                    lista += "_agente-"+$('#agente').val();
                }else{
                    lista += "_agente-null";
                }

                if($('#subagente').val() != "null"){
                    lista += "_subagente-"+$('#subagente').val();
                }else{
                    lista += "_subagente-null";
                }

                if($('#universidade').val() != "null"){
                    lista += "_universidade-"+$('#universidade').val();
                }else{
                    lista += "_universidade-null";
                }

                if($('#curso').val() != "null"){
                    lista += "_curso-"+$('#curso').val();
                }else{
                    lista += "_curso-null";
                }

                if($('#institutoOrigem').val() != "null"){
                    lista += "_institutoOrigem-"+$('#institutoOrigem').val();
                }else{
                    lista += "_institutoOrigem-null";
                }

                if($('#atividade').val() != "null"){
                    lista += "_atividade-"+$('#atividade').val();
                }else{
                    lista += "_atividade-null";
                }
                /***********    Para Eliminar   ************//*para testes*/
                //lista = "pais-russia_cidade-null_agente-null_subagente-null_universidade-null_curso-null_institutoOrigem-null_atividade-null";
                /*******************************************/
                var link = '/../api/listagem/'+lista;
                $.ajax({
                    method:"GET",
                    url:link
                })
                .done(function(response){
                    if(response != null){
                        for (i=0; i<response.results.length; i++) {
                            var resultClone = clone.clone();

                            $('.routa-show',resultClone).attr('href',"clientes/"+response.results[i].slug);
                            $('.routa-show',resultClone).text(response.results[i].nome+" "+response.results[i].apelido);

                            $('.numPassaporte',resultClone).text(response.results[i].numPassaporte);

                            $('.paisNaturalidade',resultClone).text(response.results[i].paisNaturalidade);

                            if(response.results[i].estado == "Inativo"){
                                $('.span-estado',resultClone).text('Inativo');
                                    $('.span-estado',resultClone).attr('class','span-estado text-danger');
                            }else{
                                if(response.results[i].estado == "Ativo"){
                                    $('.span-estado',resultClone).text('Ativo');
                                $('.span-estado',resultClone).attr('class','span-estado text-success');
                                }else{
                                    $('.span-estado',resultClone).text('Proponente');
                                    $('.span-estado',resultClone).attr('class','span-estado text-info');
                                }
                            }

                            $('.butao-show',resultClone).attr('href',"clientes/"+response.results[i].slug);


                            $('#table-body').append(resultClone);
                        }
                    }
                })
            }
        </script>
    @endsection
@endsection
