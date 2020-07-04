@extends('layout.master')

{{-- Page Title --}}
@section('title', 'FaseStock')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')

<div class="container-fluid my-4" style="color: black">

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">

        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Ficha da Fase <span class="active">{{ $fasestock->descricao }}</span></strong></h4>
                    <small>
                        <div>
                            <span>Ultima atualização:
                                <strong>{{ date('d-M-y', strtotime($fasestock->updated_at)) }}</strong></span>
                        </div>
                    </small>
                </div>
            </div>



            {{-- Opções --}}
            <div class="col text-right">
                <a href="#" class="btn btn-sm btn-success m-1 mr-2 px-3 " data-toggle="modal"
                    data-target="#novoDocStock"><i class="fas fa-plus mr-2 "></i>Adicionar Documento Stock</a>
            </div>

        </div>


        <hr>

        
        <hr class="my-3">

        <div class="row">
            <div class="col">
                <div class="table-responsive " style="overflow:hidden">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" row-border="0"
                        style="overflow:hidden;">
                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Documento</th>
                                <th class="text-center" style="width: 130px">Opções</th>
                            </tr>
                        </thead>
                        {{-- Corpo da tabela --}}
                        <tbody>
                            @foreach ($docstocks as $docstock)
                            <tr>
                                {{-- Tipo --}}
                                <td>{{-- <a class="name_link" href="{{route('documentostock.show',$docstock)}}"> --}}{{$docstock->tipo}}{{-- </a> --}}</td>


                                {{-- Documento --}}
                                <td>{{-- <a class="name_link" href="{{route('documentostock.show',$docstock)}}"> --}}{{$docstock->tipoDocumento}}{{-- </a> --}}</td>



                                {{-- OPÇÔES --}}
                                <td class="text-center align-middle" style="width: 130px">
                                    <a href="{{route('documentostock.edit', $docstock)}}"
                                        class="btn btn-sm btn-outline-warning mr-1" title="Editar"><i
                                            class="fas fa-pencil-alt"></i></a>

                                    <form method="POST" role="form" id="{{ $docstock->idDocStock }}"
                                        action="{{route('documentostock.destroy',$docstock)}}"
                                        class="d-inline-block form_client_id">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            title="Eliminar DocStock" data-toggle="modal" data-target="#deleteModal"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>



<!-- Modal -->
<form class="form-group needs-validation" action="{{route('documentostock.store', $fasestock)}}" method="post"
    id="form_fase" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="modal fade" id="novoDocStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Documento Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    {{-- INPUT tipo --}}
                    <label for="tipo" class="font-weight-bold">Tipo de Documento:</label><br>
                    <select type="text" class="form-control" name="tipo" id="tipodocstock" onchange="/* myFunction() */"
                        required>
                        <option value="Pessoal">Pessoal</option>
                        <option value="Academico">Academico</option>
                    </select>

                    <br>

                    {{-- INPUT tipoDocumento --}}
                    <label for="tipoDocumento" class="font-weight-bold">Nome do Documento:</label>
                    <input class="form-control" style="width: 100%;" name="tipoDocumento" required>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success px-2"><i class="fas fa-plus mr-2 "></i>Adicionar
                        Documento Stock</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>

                </div>
            </div>
        </div>
    </div>

</form>

@endsection
{{-- Scripts --}}
@section('scripts')
{{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
