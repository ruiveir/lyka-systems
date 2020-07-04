@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Produtos Stock')


{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection


{{-- Conteudo da Página --}}
@section('content')


<div class="container-fluid my-4 ">
    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Listagem de Produtos Stock</strong></h4>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                @if (Auth::user()->tipo == "admin")
                <a href="{{route('produtostock.create')}}" class="btn btn-sm btn-success px-2"><i
                        class="fas fa-plus mr-2"></i>Adicionar Produto Stock</a>
                @endif
            </div>

        </div>

        <hr>

        <div class="row my-2">
            <div class="col">
                <div class="text-secondary"><strong>Estão registados no sistema {{$totalprodutostock}} produtos stock, {{$totalfasestock}} fases stock e {{$totaldocstock}} documentos stock.</strong></div>
            </div>

        </div>



        <div class="row my-2">

            {{-- Espaço ocupado no storage/library --}}
            <div class="col ">
                {{-- Input para pesquisa na datatable --}}
                <input type="text" class="shadow-sm" id="customSearchBox" placeholder="Procurar nos resultados..."
                    aria-label="Procurar" style="width: 100%">

            </div>

        </div>


        <div class="row mt-4">

            <div class="col">

                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover" style="width:100%">

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Tipo</th>
                                <th>Ano Académico</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>

                        {{-- Corpo da tabela --}}
                        <tbody>
                            @foreach ($produtoStocks as $produtoStock)
                            <tr>
                                {{-- Descrição --}}
                                <td class="align-middle"><a class="name_link" href="{{route('produtostock.show',$produtoStock)}}">{{ $produtoStock->descricao }}</a></td>

                                {{-- Tipo --}}
                                <td class="align-middle">{{ $produtoStock->tipoProduto}}</td>

                                {{-- Ano Académico --}}
                                <td class="align-middle">{{ $produtoStock->anoAcademico }}</td>

                                {{-- OPÇÔES --}}
                                <td class="text-center align-middle">
                                    <a href="{{route('produtostock.show',$produtoStock)}}" class="btn btn-sm btn-outline-primary" title="Ver ficha completa"><i class="far fa-eye"></i></a>

                                    <a href="{{route('produtostock.edit', $produtoStock)}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>

                                    <form method="POST" role="form" id="{{ $produtoStock->idProdutoStock }}"
                                        action="{{route('produtostock.destroy',$produtoStock)}}" class="d-inline-block form_client_id">
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

            </div>
        </div>
    </div>
</div>

@endsection

{{-- Utilização de scripts: --}}
@section('scripts')
<script src="{{asset('/js/produtoStock.js')}}"></script>

@endsection
