@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de Universidade')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">

<style>
    .edit_event_btn {
        display: inline-block;
        width: 26px;
        height: 26px;
        font-size: 14px;
        border-radius: 50%;
        background-color: white;
        border: 1px solid lightgray;
    }

    .delete_event_btn {
        width: 26px;
        height: 26px;
        font-size: 14px;
        border-radius: 50%;
        background-color: white;
        border: 1px solid lightgray;
    }

    @media screen and (max-width: 1200px) {

        #dataTableContacts th:nth-of-type(1),
        #dataTableContacts td:nth-of-type(1) {
            display: none;
        }

    }

</style>
@endsection



{{-- Page Content --}}
@section('content')

{{-- Inclui a modal da agenda, utilizando as variaveis para a universidade --}}
@include('agends.partials.modal')

{{-- Inclui a modal de confirmação para apagar contacto --}}
@include('contacts.partials.modal')


{{-- Inclui a modal de confirmação para apagar evento--}}
@include('universities.partials.modal-events')




<div class="container-fluid my-4">

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">

        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Ficha de Universidade <span class="active">{{$university->nome}}</span></strong></h4>
                </div>
                <div><small>Ultima atualização:
                        <strong>{{ date('d-M-y', strtotime($university->updated_at)) }}</strong></small></div>
            </div>

            {{-- Opções --}}
            @if (Auth::user()->tipo == "admin")
                <div class="col text-right">
                    <a href="#" id="titleModalNew" class="btn btn-sm btn-primary m-1 mr-2 px-2" data-toggle="modal"
                    data-target="#modalCalendar" style="width: 156px"><i class="fas fa-calendar-alt mr-2"></i>Adicionar evento</a>

                <a href="{{route('contacts.create',$university)}}" class="btn btn-sm btn-primary m-1 mr-2 px-2" style="width: 156px">
                    <i class="fas fa-address-book mr-2"></i>Adicionar contacto</a>

                    <a href="{{route('universities.edit',$university)}}" class="btn btn-sm btn-success m-1 mr-2 px-3">
                        <i class="fas fa-pencil-alt mr-2"></i>Editar Informação</a>
                </div>
            @endif
        </div>

        <hr class="my-3">


            <div class="row p-2">

                <div class="col p-2" style="min-width:350px !important">

                    {{-- Informações --}}

                    <div class="row">

                        <div class="col">
                            <div>Morada:<br>
                                @if( $university->morada!="" )
                                    <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$university->morada}}</div>
                                @else
                                    <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                                @endif
                            </div>
                            <br>
                        </div>

                        <div class="col">
                            <div>E-Mail:<br>
                                @if( $university->email!="" )
                                    <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$university->email}}</div>
                                @else
                                    <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                                @endif
                            </div>
                            <br>
                        </div>

                        <div class="col">
                            <div>Telefone:<br>
                                @if( $university->telefone!="" )
                                    <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$university->telefone}}</div>
                                @else
                                    <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                                @endif
                            </div>
                            <br>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col">
                            <div>NIF:<br>
                                @if( $university->NIF!="" )
                                    <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$university->NIF}}</div>
                                @else
                                    <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                                @endif
                            </div>
                            <br>
                        </div>
                        <div class="col">
                            <div>IBAN:<br>
                                @if( $university->IBAN!="" )
                                    <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$university->IBAN}}</div>
                                @else
                                    <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                                @endif
                            </div>
                            <br>
                        </div>
                    </div>

                </div>
            </div>



        <div class="row nav nav-fill w-100 text-center mx-auto p-3 ">


            <a class="nav-item nav-link active border p-3 m-1 bg-white rounded shadow-sm name_link" id="eventos-tab"
                data-toggle="tab" href="#eventos" role="tab" aria-controls="eventos" aria-selected="true">
                <div class="col"><i class="fas fa-calendar-alt mr-2"></i>Eventos</div>
            </a>


            @if (Auth::user()->tipo == "admin")
            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="estudantes-tab"
                data-toggle="tab" href="#estudantes" role="tab" aria-controls="estudantes" aria-selected="false">
                <div class="col">
                    <i class="fas fa-user mr-2"></i>
                    Estudantes
                </div>
            </a>
            @endif


            @if (Auth::user()->tipo == "admin")
                <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="contactos-tab"
                    data-toggle="tab" href="#contactos" role="tab" aria-controls="contactos" aria-selected="false">
                    <div class="col"><i class="fas fa-address-book mr-2"></i>Lista telefónica</div>
                </a>
            @endif


            <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link border" id="observacoes-tab"
                data-toggle="tab" href="#observacoes" role="tab" aria-controls="observacoes" aria-selected="false">
                <div class="col"><i class="fas fa-pencil-alt mr-2"></i>Observações</div>
            </a>

        </div>


        <div class="border shadow-sm mb-4 p-4" style="margin-top:-30px">
            <div class="tab-content p-2 mt-3" id="myTabContent">

                {{-- Eventos --}}
                <div class="tab-pane fade show active" id="eventos" role="tabpanel" aria-labelledby="eventos-tab">
                    @if($eventos!=null)
                    <div class="row mx-auto pt-0" style="max-height:1000px; overflow:auto ">
                        @foreach ($eventos as $agenda)

                        <div>
                            <div class="col border rounded bg-light shadow-sm  m-2 mt-4 p-3"
                                style="min-width: 320px; max-width: 320px; height:auto; max-height:240px; color:black !important">

                                <div class="row p-0 m-0" style="margin-top:-30px!important">
                                    <div class="col text-right p-0">

                                        @if (Auth::user()->tipo == "admin")
                                        {{-- APAGAR --}}
                                        <form method="POST" role="form" id="#"
                                            action="{{route('agenda.destroy',$agenda)}}"
                                            class="d-inline-block form_university_event" data="{{$agenda->titulo}}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="delete_event_btn shadow-sm text-center btn_list_opt btn_delete mr-2"
                                                title="Eliminar Evento" data-toggle="modal" data-target="#exampleModal">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-2"><i class="fas fa-square mr-2" title="{{$agenda->titulo}}"
                                        style="color:{{$agenda->cor}}"></i>Evento:
                                    <strong>{{ \Illuminate\Support\Str::limit($agenda->titulo, 50, $end=' (...)') }}</strong>
                                </div>

                                <div class="mt-3">
                                    {{ \Illuminate\Support\Str::limit($agenda->descricao, 70, $end=' (...)') }}</div>


                                <div class="row ">

                                    <div class="col border-right ">
                                        <div class="mt-3">
                                            Inicio:<br><strong>{{ date('d-M-y', strtotime($agenda->dataInicio)) }}</strong>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mt-3">
                                            Fim:<br><strong>{{ date('d-M-y', strtotime($agenda->dataFim)) }}</strong>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        @endforeach
                    </div>
                    @else
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem registos)</small></div>
                    </div>
                    @endif


                </div>


                {{-- Lista de estudantes --}}

                @if (Auth::user()->tipo == "admin")
                <div class="tab-pane fade " id="estudantes" role="tabpanel" aria-labelledby="estudantes-tab">

                    @if($clients)

                    <div class="row">

                        <div class="col">
                            <div class="text-secondary">Existe {{count($clients)}} estudante(s) associados a esta
                                Universidade</div>
                            <br>
                            {{-- Input de procura nos resultados da dataTable --}}
                            <input type="text" class="shadow-sm" id="customSearchBox"
                                placeholder="Procurar nos resultados..." aria-label="Procurar" style="width: 100%">
                        </div>

                    </div>

                    <br>

                    <div class="table-responsive">
                        <table id="dataTable" class="display table table-bordered table-hover " style="width:100%">

                            {{-- Cabeçalho da tabela --}}
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>N.º Passaporte</th>
                                    <th>País</th>
                                    <th>Estado</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                            </thead>

                            {{-- Corpo da tabela --}}
                            <tbody>

                                @foreach ($clients as $client)
                                <tr class="font-weight-normal">
                                    {{-- Nome e Apelido --}}
                                    <td class="align-middle"><a class="name_link"
                                            href="{{route('clients.show',$client)}}">{{ $client->nome }}
                                            {{ $client->apelido }}</a>
                                    </td>

                                    {{-- numPassaporte --}}
                                    <td class="align-middle">{{ $client->numPassaporte }}</td>


                                    {{-- paisNaturalidade --}}
                                    <td class="align-middle">{{ $client->paisNaturalidade }}</td>


                                    {{-- Estado --}}
                                    <td class="align-middle">
                                        @if ( $client->estado == "Ativo")
                                        <span class="text-success">Ativo</span>
                                        @elseif( $client->estado == "Inativo")
                                        <span class="text-danger">Inativo</span>
                                        @else
                                        <span class="text-info">Proponente</span>
                                        @endif
                                    </td>


                                    {{-- OPÇÔES --}}
                                    <td class="text-center align-middle">

                                        <a href="{{route('clients.show',$client)}}" class="btn btn-sm btn-outline-primary"
                                            title="Ver ficha completa"><i class="far fa-eye"></i></a>

                                        @if (Auth::user()->tipo == "admin")
                                        <a href="{{route('clients.edit',$client)}}"
                                            class="btn btn-sm btn-outline-warning" title="Editar"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem registos)</small></div>
                    </div>

                    @endif

                </div>
                @endif



                {{-- Lista de contactos --}}
                @if (Auth::user()->tipo == "admin")
                <div class="tab-pane fade" id="contactos" role="tabpanel" aria-labelledby="contactos-tab"
                    style="font-weight:normal">
                    @if ($contacts)

                    <div class="table-responsive">
                        <table id="dataTableContacts" class="display table table-bordered table-hover "
                            style="width:100%">

                            {{-- Cabeçalho da tabela --}}
                            <thead>
                                <tr>
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
                                    {{-- Nome --}}
                                    <td class="align-middle">
                                        {{-- Contacto favorito?? --}}
                                        @if($contact->favorito)
                                        <i class="fas fa-star text-warning mr-1" title="Contacto favorito"
                                            style="font-size:12px"></i>
                                        @endif
                                        <a class="name_link"
                                            href="{{route('contacts.show',[$contact,$university])}}">{{$contact->nome}}</a>
                                    </td>

                                    {{-- numPassaporte --}}
                                    <td class="align-middle">{{ $contact->email }}</td>


                                    {{-- paisNaturalidade --}}
                                    <td class="align-middle">{{ $contact->telefone1 }}</td>


                                    {{-- OPÇÔES --}}
                                    <td class="text-center align-middle">
                                        <a href="{{route('contacts.show',[$contact,$university])}}"
                                            class="btn btn-sm btn-outline-primary" title="Ver ficha completa"><i
                                                class="far fa-eye"></i></a>
                                        <a href="{{route('contacts.edit',[$contact,$university])}}"
                                            class="btn btn-sm btn-outline-warning" title="Editar"><i
                                                class="fas fa-pencil-alt"></i></a>

                                        <form method="POST" role="form" id="{{ $contact->idContacto }}"
                                            action="{{route('contacts.destroy',$contact)}}" data="{{ $contact->nome }}"
                                            class="d-inline-block form_contact_id">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar contacto"
                                                data-toggle="modal" data-target="#staticBackdrop">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    @else
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem dados para mostrar)</small></div>
                    </div>
                    @endif
                </div>
                @endif


                {{-- Observações --}}
                <div class="tab-pane fade" id="observacoes" role="tabpanel" aria-labelledby="observacoes-tab" style="color: black; font-weight:normal">

                    <div class="mb-2">Observações gerais:</div>
                    <div class="border rounded bg-light p-3">
                        @if ($university->observacoes)
                        <span class="font-weight-bold">{{$university->observacoes}}</span>
                        @else
                        <div class="text-muted"><small>(sem dados para mostrar)</small></div>
                    @endif
                    </div>

                    <br>

                    <div class="mb-2">Observação dos Candidaturas:</div>
                    <div class="border rounded bg-light p-3">
                    @if ($university->obsCandidaturas)
                    <span class="font-weight-bold">{{$university->obsCandidaturas}}</span>
                    @else
                    <div class="text-muted"><small>(sem dados para mostrar)</small></div>
                    @endif
                    </div>

                    <br>

                    <div class="mb-2">Observação dos Cursos:</div>
                    <div class="border rounded bg-light p-3">
                    @if ($university->obsCursos)
                    <span class="font-weight-bold">{{$university->obsCursos}}</span>
                    @else
                    <div class="text-muted"><small>(sem dados para mostrar)</small></div>
                    @endif
                </div>
            </div>

        </div>


    </div>
</div>

</div>
</div>
</div>



@endsection
{{-- Scripts --}}
@section('scripts')
<script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>
<script src="{{asset('/js/university_show.js')}}"></script>
<script src="{{asset('/js/agends.js')}}"></script>
<script src="{{asset('/js/newEventModalDefault.js')}}"></script>
@endsection
