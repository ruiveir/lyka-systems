@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem de fornecedores')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Conteúdo da Página --}}
@section('content')




<div class="container-fluid my-4">
    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">

        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Listagem de fornecedores</strong></h4>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                <a href="{{route('provider.create')}}" class="btn btn-sm btn-success px-2"><i
                        class="fas fa-plus mr-2"></i>Adicionar fornecedor</a>
            </div>

        </div>


        <div class="row my-2">
            <div class="col">
                @if($providers)
                <div class="text-secondary"><strong>Existe {{count($providers)}} registo(s) no sistema</strong>
                </div>
                @endif
            </div>
        </div>


        <div class="row my-2">
            <div class="col ">
                {{-- Input para pesquisa na datatable --}}
                <input type="text" class="shadow-sm" id="customSearchBox" placeholder="Procurar nos resultados..."
                    aria-label="Procurar" style="width: 100%">
            </div>
        </div>



        <div class="row mt-4">

            <div class="col">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover " style="width:100%">
                        <thead>
                            <tr style="border-bottom: 2px solid #dee2e6;">
                                <th>Nome</th>
                                <th>Morada</th>
                                <th>Contacto</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($providers as $provider)
                            <tr>
                                <td class="align-middle">
                                    <a href="{{route('provider.show', $provider)}}" title="Ver ficha completa">{{$provider->nome}}</a>
                                </td>

                                <td class="align-middle">{{$provider->morada}}</td>

                                <td class="align-middle text-truncate">{{$provider->contacto}}</td>

                                {{-- Opções --}}
                                <td class="text-center align-middle" style="min-width: 120px;">

                                    <a href="{{route('provider.show', $provider)}}" class="btn btn-sm btn-outline-primary"
                                        title="Ver ficha completa"><i class="far fa-eye"></i></a>


                                    <a href="{{route('provider.edit', $provider)}}"
                                        class="btn btn-sm btn-outline-warning" title="Editar"><i
                                            class="fas fa-pencil-alt"></i></a>

                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar fornecedor"
                                        data-toggle="modal" data-target="#deleteModal" data-name="{{$provider->nome}}"
                                        data-descricao="{{post_slug($provider->descricao)}}"><i
                                            class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar fornecedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="POST">
                    @csrf
                    @method('DELETE')
                    <p id="text"></p>
                    <br>
                    <p style="font-weight:500;">Ao clicar "Sim, eliminar fornecedor", irá eliminar a conta
                        definitivamente e perder todos os dados associados.</p>
                    <input type="hidden" id="provider-delete-descricao" name="id">
            </div>
            <div class="modal-footer">
                <button class="top-button btn_submit bg-danger" type="submit"><i class="far fa-trash-alt mr-2"></i>Sim,
                    eliminar fornecedor</button>
                <button type="button" class="top-button bg-secondary mr-2" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('/js/providers_list.js')}}"></script>

@endsection
