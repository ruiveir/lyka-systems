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
            <div class="title">
                <h6>Listagem:</h6>
                <select id="">
                  <option>Escolher Opção:</option>
                  <option value="Administradores">Administradores</option>
                  <option value="Agentes">Agentes</option>
                  <option value="Clientes">Clientes</option>
                  <option value="Universidades">Universidades</option>
                  <option value="Produtos Stock">Produtos Stock</option>
                </select>
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
                    @foreach ($clientes as $cliente)
                    <tr {{--id="clonar"--}}>
                        {{-- Só mostras os clientes ativos ou proponentes --}}
                        {{-- Nome e Apelido --}}
                        <td class="align-middle">
                            <a class="routa-show name_link" href="#">{{$cliente->nome ." ". $cliente->apelido}}</a>
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
                            <a href="#" class="butao-show btn btn-sm btn-outline-primary"
                                title="Ver ficha completa"><i class="far fa-eye"></i></a>

                            {{-- Permissões para editar --}}
                            <a href="#" class="butao-editar btn btn-sm btn-outline-warning"
                                title="Editar"><i class="fas fa-pencil-alt"></i>
                            </a>

                            {{-- Opção APAGAR --}}
                            <form method="POST" role="form" id=""
                                action="#"
                                data="" class="d-inline-block form_client_id butao-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar estudante"
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
    @section('scripts')
        <script type="text/javascript">
            var clone = $('#clonar').clone();
            $('#clonar').remove();

            function GetList(){
                $('#table-body').html("");

                var lista = null;

                if($('#pais').value() != "null"){
                    lista = "pais-"+$('#pais').value();
                }else{
                    lista = "pais-null";
                }

                if($('#cidade').value() != "null"){
                    lista = "_cidade-"+$('#cidade').value();
                }else{
                    lista = "_cidade-null";
                }

                if($('#agente').value() != "null"){
                    lista = "_agente-"+$('#agente').value();
                }else{
                    lista = "_agente-null";
                }

                if($('#subagente').value() != "null"){
                    lista = "_subagente-"+$('#subagente').value();
                }else{
                    lista = "_subagente-null";
                }

                if($('#universidade').value() != "null"){
                    lista = "_universidade-"+$('#universidade').value();
                }else{
                    lista = "_universidade-null";
                }

                if($('#curso').value() != "null"){
                    lista = "_curso-"+$('#curso').value();
                }else{
                    lista = "_curso-null";
                }

                if($('#institutoOrigem').value() != "null"){
                    lista = "_institutoOrigem-"+$('#institutoOrigem').value();
                }else{
                    lista = "_institutoOrigem-null";
                }

                if($('#atividade').value() != "null"){
                    lista = "_atividade-"+$('#atividade').value();
                }else{
                    lista = "_atividade-null";
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

                            $('.routa-show',resultClone).attr('href',"{{route('clients.show',"+response.results[i].idCliente+")}}");
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

                            $('.butao-show',resultClone).attr('href',"{{route('clients.show',"+response.results[i].idCliente+")}}");

                            $('.butao-editar',resultClone).attr('href',"{{route('clients.edit',"+response.results[i].idCliente+")}}");

                            $('.butao-delete',resultClone).attr('href',"{{route('clients.destroy',"+response.results[i].idCliente+")}}");
                            $('.butao-delete',resultClone).attr('id',response.results[i].idCliente);
                            $('.butao-delete',resultClone).attr('data',response.results[i].nome+" "+response.results[i].apelido);

                            $('#table-body').append(resultClone);
                        }
                    }
                })
            }
        </script>
    @endsection
@endsection
