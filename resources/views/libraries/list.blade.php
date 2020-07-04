@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Biblioteca')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

@endsection


{{-- Conteudo da Página --}}
@section('content')

<!-- MODAL DE INFORMAÇÔES -->
@include('libraries.partials.modal')


<div class="container-fluid my-4">
    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Biblioteca de ficheiros</strong></h4>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                @if (Auth::user()->tipo == "admin")
                <a href="{{route('libraries.create')}}" class="btn btn-sm btn-success px-2"><i
                        class="fas fa-plus mr-2"></i>Adicionar Ficheiro</a>
                @endif
            </div>

        </div>

        <hr class="my-3">


        <div class="row my-2">
            <div class="col">
                @if($files)
                <div class="text-secondary m-1"><strong>Existe {{count($files)}} ficheiro(s) disponíveis no sistema</strong>
                </div>
                @endif
            </div>
            <div class="col text-right">
                @if (Auth::user()->tipo == "admin")
                <span class="p-2 px-3 border bg-light">
                <small><strong>Espaço ocupado: {{$size}}</strong></small>
                </span>
                @endif
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

                @if($files)
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover " style="width:100%">

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>
                                <th class="align-content-center ">Descrição do ficheiro</th>
                                <th class="align-content-center">Tamanho</th>
                                <th class="align-content-center">Tipo</th>
                                <th class="align-content-center">Data</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>

                        {{-- Corpo da tabela --}}
                        <tbody>

                            @foreach ($files as $library)
                            {{-- Descrição --}}
                            <td>
                                <i class="fas fa-file-alt"></i>
                                @if ($library->acesso =="Privado")
                                <small><i class="fas fa-lock text-warning ml-1" title="Ficheiro Privado"></i></small>
                                @endif
                                <a download href="{{Storage::disk('public')->url('library/'.$library->ficheiro)}}"
                                    class="name_link ml-2">{{ \Illuminate\Support\Str::limit($library->descricao, 50, $end=' (...)') }}</a>

                            </td>


                            {{-- Tamanho --}}
                            <td>{{ $library->tamanho }} </td>

                            {{-- tipo de ficheiro --}}
                            <td>{{ $library->tipo }} </td>


                            {{-- Data de criação --}}
                            <td>{{ date('d-M-y', strtotime($library->updated_at)) }} </td>

                            {{-- OPÇÔES --}}
                            <td class="text-center align-middle align-content-center">

                                {{-- Download --}}
                                <a download href="{{Storage::disk('public')->url('library/'.$library->ficheiro)}}"
                                    class="btn btn-sm btn-outline-primary " title="Fazer download do ficheiro"><i
                                        class="fas fa-download"></i></a>


                                {{-- Editar --}}
                                @if (Auth()->user()->tipo == "admin")
                                <a href="{{route('libraries.edit',$library)}}" class="btn btn-sm btn-outline-warning"
                                    title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                @endif

                                {{-- Admins: Apagar ficheiro --}}
                                @if (Auth::user()->tipo == "admin")
                                <form method="POST" role="form" id="{{ $library->idBiblioteca }}"
                                    action="{{route('libraries.destroy',$library)}}" data="{{ $library->descricao }}"
                                    class="d-inline-block form_file_id">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar ficheiro"
                                        data-toggle="modal" data-target="#deleteModal"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                                @endif

                            </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                @else

                <div class="border rounded bg-light p-2" style="height:155px; overflow: auto; color:black">
                    <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                </div>

                @endif

            </div>

        </div>

    </div>
</div>

@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/library.js')}}"></script>

@endsection
