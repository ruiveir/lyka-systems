@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de Universidades')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

@endsection


{{-- Conteudo da Página --}}
@section('content')
@include('universities.partials.modal')
<!-- MODAL DE INFORMAÇÔES -->



<div class="container-fluid my-4">

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">

        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Listagem de Universidades</strong></h4>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                @if (Auth::user()->tipo == "admin")
                <a href="{{route('universities.create')}}" class="btn btn-sm btn-success px-2"><i
                        class="fas fa-plus mr-2"></i>Adicionar Universidade</a>
                @endif
            </div>

        </div>


        <hr>

        @if($universities)

        <div class="row">
            <div class="col">
                {{-- Contagem dos clientes ativos ou proponentes --}}
                <div class="text-muted my-2">
                    <strong>Existe {{count($universities)}} registo(s) no sistema</strong>
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

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>

                                <th>Nome da universidade</th>
                                <th>NIF</th>
                                <th>E-mail</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>

                        {{-- Corpo da tabela --}}
                        <tbody>

                            @foreach ($universities as $university)
                            <tr>

                                {{-- Nome --}}
                                <td class="align-middle"><a class="name_link"
                                        href="{{route('universities.show',$university)}}">{{ $university->nome }}</td>

                                {{-- NIF --}}
                                <td class="align-middle">{{ $university->NIF }}</td>


                                {{-- E-Mail --}}
                                <td class="align-middle">{{ $university->email }}</td>


                                {{-- OPÇÔES --}}
                                <td class="text-center align-middle">
                                    <a href="{{route('universities.show',$university)}}" class="btn btn-sm btn-outline-primary"
                                        title="Ver ficha completa"><i class="far fa-eye"></i></a>



                                    @if (Auth::user()->tipo == "admin")
                                        <a href="{{route('universities.edit',$university)}}"
                                            class="btn btn-sm btn-outline-warning" title="Editar"><i
                                                class="fas fa-pencil-alt"></i></a>

                                        <form method="POST" role="form" id="{{ $university->idUniversidade }}"
                                            action="{{route('universities.destroy',$university)}}"
                                            class="d-inline-block form_university_id" data="{{ $university->nome }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar Universidade"
                                                data-toggle="modal" data-target="#eliminarUniversidade"
                                                data-title="{{$university->nome}}"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @else

        <div class="border rounded bg-light p-2 mt-4" >
                <span class="text-muted"><small>(sem dados para mostrar)</small></span>
        </div>

        @endif


    </div>
</div>

@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/university.js')}}"></script>

@endsection
