@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Listagem de contas bancárias')

{{-- Estilos de CSS --}}
@section('styleLinks')

{{-- <link href="{{asset('/css/conta.css')}}" rel="stylesheet"> --}}
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
                    <h4><strong>Listagem de Contas Bancárias</strong></h4>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                <a href="{{route('conta.create')}}" class="btn btn-sm btn-success px-3"><i
                        class="fas fa-plus mr-2"></i>Adicionar Conta Bancária</a>
            </div>

        </div>

        <hr>


        <div class="row">
            <div class="col">
                {{-- Contagem dos Agentes --}}
                <div class="text-muted my-2">
                    <strong>Existe <strong>{{count($contas)}}</strong> registo(s) no sistema</strong>
                </div>
                <div>
                    {{-- Input de procura nos resultados da dataTable --}}
                    <input type="text" class="shadow-sm" id="customSearchBox" placeholder="Procurar nos resultados..."
                        aria-label="Procurar" style="width:100%;">
                </div>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover " style="width:100%">
                    <thead>
                        <tr style="border-bottom: 2px solid #dee2e6;">
                            <th>Descrição</th>
                            <th>Instituição</th>
                            <th>Contacto</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contas as $conta)
                        <tr>
                            <td class="align-middle">{{$conta->descricao}}</td>

                            <td class="align-middle">{{$conta->instituicao}}</td>

                            <td class="align-middle text-truncate">{{$conta->contacto}}</td>


                            {{-- Opções --}}
                            <td class="text-center align-middle" style="min-width: 120px;">
                                <a href="{{route('conta.show', $conta)}}" class="btn btn-sm btn-outline-primary " title="Ver ficha completa"><i class="far fa-eye"></i></a>
                                <a href="{{route('conta.edit', $conta)}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar conta bancária" data-toggle="modal" data-target="#deleteModal" data-name="{{$conta->descricao}}" data-slug="{{$conta->slug}}"><i class="fas fa-trash-alt"></i></button>
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
                <h5 class="modal-title">Eliminar conta bancária</h5>
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
                    <p style="font-weight:500;">Ao clicar "Sim, eliminar conta", irá eliminar a conta definitivamente e perder todos os dados associados.</p>
            </div>
            <div class="modal-footer">
                <button class="top-button btn_submit bg-danger" type="submit"><i class="far fa-trash-alt mr-2"></i>Sim, eliminar conta</button>
                <button type="button" class="top-button bg-secondary mr-2" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')

<script src="{{asset('/js/conta.js')}}"></script>

@endsection

@endsection
