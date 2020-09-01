@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Lista de contactos')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">


@endsection


{{-- Conteudo da Página --}}
@section('content')

<!-- MODAL DE INFORMAÇÔES -->
@include('contacts.partials.modal')



<div class="container-fluid my-4">
    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Lista Telefónica</strong></h4>
                </div>
            </div>

            {{-- Opções --}}
            @if($favorito)
                <div class="col text-right">
                    <a href="{{route('contacts.index')}}" class="btn btn-sm btn-info px-2" style="color:black;font-weight: bold; width: 35%">Mostrar Todos</a>
                </div>
            @else
                <div class="col text-right">
                    <a href="{{route('contacts.favoritos')}}" class="btn btn-sm btn-danger px-2" style="color:black;font-weight: bold;"><i class="fas fa-star text-warning mr-2" title="Contacto favorito"
                        style="font-size:12px"></i>Mostrar Favoritos</a>
                </div>
            @endif
            <div class="col text-right">
                <a href="{{route('contacts.create')}}" class="btn btn-sm btn-success px-2"><i
                        class="fas fa-plus mr-2"></i>Adicionar Contacto</a>
            </div>

        </div>

        <hr>

        <div class="row my-2">
            <div class="col">
                @if($contacts)
                <div class="text-secondary"><strong>Existe {{count($contacts)}} contacto(s) registados</strong>
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


            @if($contacts)

            <div class="col">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover " style="width:100%">

                        {{-- Cabeçalho da tabela --}}
                        <thead>
                            <tr>

                                <th class="text-center align-content-center ">Foto
                                    {{-- <input class="table-check" type="checkbox" value="" id="check_all"> --}}
                                </th>

                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>

                        {{-- Corpo da tabela --}}
                        <tbody>
                            @foreach ($contacts as $contact)
                            <tr>
                                <td>
                                    <div class="align-middle mx-auto shadow-sm rounded bg-white"
                                        style="overflow:hidden; width:50px; height:50px">
                                        <a class="name_link" href="{{route('contacts.show',$contact)}}">
                                            @if($contact->fotografia)
                                            <img src="{{url('/storage/contact-photos/').$contact->fotografia}}"
                                                width="100%" class="mx-auto">
                                            @else
                                                <img src="
                                                {{url('/storage/default-photos/M.jpg')}}" width="100%"
                                                class="mx-auto">
                                            @endif
                                        </a>
                                    </div>

                                </td>

                                {{-- Nome e Apelido --}}
                                <td class="align-middle">
                                    @if($contact->favorito)
                                    <i class="fas fa-star text-warning mr-2" title="Contacto favorito"
                                        style="font-size:12px"></i>
                                    @endif

                                    <a class="name_link" href="{{route('contacts.show',$contact)}}">
                                        {{$contact->nome}}</a>
                                </td>

                                {{-- e-mail --}}
                                <td class="align-middle">
                                    @if ($contact->email==null)
                                    <span class="text-muted" style="font-weight:normal"><small>(sem
                                            informação)</small><span>
                                            @else
                                            {{$contact->email}}
                                            @endif
                                </td>

                                {{-- Telefone(1) --}}
                                <td class="align-middle">
                                    @if ($contact->telefone1==null)
                                    <span class="text-muted" style="font-weight:normal"><small>(sem
                                            informação)</small><span>
                                            @else
                                            {{$contact->telefone1}}
                                            @endif
                                </td>


                                {{-- OPÇÔES --}}
                                <td class="text-center align-middle">
                                    <a href="{{route('contacts.show',$contact)}}" class="btn btn-sm btn-outline-primary "
                                        title="Ver ficha completa"><i class="far fa-eye"></i></a>


                                    <a href="{{route('contacts.edit',$contact)}}" class="btn btn-sm btn-outline-warning"
                                        title="Editar"><i class="fas fa-pencil-alt"></i></a>

                                    <form method="POST" role="form" id="{{ $contact->idContacto }}"
                                        action="{{route('contacts.destroy',$contact)}}" data="{{ $contact->nome }}"
                                        class="d-inline-block form_contact_id">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar contacto"
                                            data-toggle="modal" data-target="#staticBackdrop"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

                @else

                <div class="border rounded bg-light p-2 mt-4" >
                    <span class="text-muted"><small>(sem dados para mostrar)</small></span>
                </div>

                @endif
            </div>

            </div>
        </div>
    </div>
</div>









@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

<script src="{{asset('/js/contacts.js')}}"></script>

@endsection
