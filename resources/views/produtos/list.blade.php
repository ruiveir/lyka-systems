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
                    <h4><strong>Escolha um Produto Stock</strong></h4>
                </div>
            </div>

        </div>

        <hr>


        @if($produtosStock)
        <div class="table-responsive mt-4">
            <table id="dataTable" class="table table-bordered table-hover text-black" style="width:100%">

                {{-- Cabeçalho da tabela --}}
                <thead>
                    <tr>
                        {{--<th class="text-center align-content-center ">Foto</th> --}}
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th>Ano Académico</th>
                        <th>Nº Fases</th>
                        <!--<th class="text-center">Opções</th>-->
                    </tr>
                </thead>

                {{-- Corpo da tabela --}}
                <tbody>

                    @foreach ($produtosStock as $produtoStock)

                    <tr>
                        {{-- --}}


                        {{--  --}}
                        <td class="align-middle"><a class="name_link" href="{{route('produtos.create',[$client,$produtoStock])}}">{{ $produtoStock->tipoProduto}}</a> </td>

                        {{--  --}}
                        <td class="align-middle"><a class="name_link" href="{{route('produtos.create',[$client,$produtoStock])}}">{{ $produtoStock->descricao }}</a> </td>

                        {{--  --}}
                        <td class="align-middle"><a class="name_link" href="{{route('produtos.create',[$client,$produtoStock])}}">{{ $produtoStock->anoAcademico }}</a> </td>

                        {{--  --}}
                        @php
                            $fases = $produtoStock->faseStock;
                            $numFases = count($fases->toArray()); 
                        @endphp
                        <td class="align-middle"><a class="name_link" href="{{route('produtos.create',[$client,$produtoStock])}}">{{ $numFases}}</a> </td>

                    </tr>
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
