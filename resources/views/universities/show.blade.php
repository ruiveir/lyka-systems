@extends('layout.master')
<!-- Page Title -->
@section('title', 'Visualização de uma universidade')
<!-- Page Content -->
@section('content')
@include('contacts.partials.modal')
@include('universities.partials.modal-events')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Visualização de uma universidade</h1>
        <div>
            <a href="{{route('contacts.create', $university)}}" class="btn btn-primary btn-icon-split btn-sm" title="Criar contacto">
                <span class="icon text-white-50">
                    <i class="fas fa-address-book"></i>
                </span>
                <span class="text">Criar contacto</span>
            </a>
            <a href="{{route('universities.edit', $university)}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="text">Editar universidade</span>
            </a>
            <a href="#" id="titleModalNew" data-toggle="modal" data-target="#infoModal" class="btn btn-secondary btn-icon-split btn-sm" title="Informações">
                <span class="icon text-white-50">
                    <i class="fas fa-info-circle"></i>
                </span>
                <span class="text">Informações</span>
            </a>
        </div>
    </div>
    <!-- Approach -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Visualização da universidade {{$university->nome}}</h6>
        </div>
        <div class="card-body">
            <div class="row pl-2 pr-2 text-gray-900">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="font-weight-bold">Morada:</div>
                            <div>
                                @if($university->morada)
                                    <div class="border rounded bg-light p-2 mt-1">{{$university->morada}}</div>
                                @else
                                    <div class="border rounded bg-light p-2 text-muted mt-2">N/A</div>
                                @endif
                            </div>
                            <br>
                        </div>

                        <div class="col">
                            <div class="font-weight-bold">E-Mail:</div>
                            <div>
                                @if($university->email)
                                    <div class="border rounded bg-light p-2 mt-1">{{$university->email}}</div>
                                @else
                                    <div class="border rounded bg-light p-2 text-muted mt-2">N/A</div>
                                @endif
                            </div>
                            <br>
                        </div>

                        <div class="col">
                            <div class="font-weight-bold">Telefone:</div>
                            <div>
                                @if($university->telefone)
                                    <div class="border rounded bg-light p-2 mt-1">{{$university->telefone}}</div>
                                @else
                                    <div class="border rounded bg-light p-2 text-muted mt-2">N/A</div>
                                @endif
                            </div>
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="font-weight-bold">NIF:</div>
                            <div>
                                @if($university->NIF)
                                    <div class="border rounded bg-light p-2 mt-1">{{$university->NIF}}</div>
                                @else
                                    <div class="border rounded bg-light p-2 text-muted mt-2">N/A</div>
                                @endif
                            </div>
                            <br>
                        </div>
                        <div class="col">
                            <div class="font-weight-bold">IBAN:</div>
                            <div>
                                @if($university->IBAN)
                                    <div class="border rounded bg-light p-2 mt-1">{{$university->IBAN}}</div>
                                @else
                                    <div class="border rounded bg-light p-2 text-muted mt-2">N/A</div>
                                @endif
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row nav nav-fill w-100 text-center mx-auto p-3">
                <a class="nav-item nav-link active border p-3 m-1 bg-primary text-white rounded shadow-sm name_link" id="eventos-tab" data-toggle="tab" href="#eventos" role="tab" aria-controls="eventos" aria-selected="true">
                    <div class="col"><i class="fas fa-calendar-alt mr-2"></i>Eventos</div>
                </a>

                @if (Auth::user()->tipo == "admin")
                    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="estudantes-tab" data-toggle="tab" href="#estudantes" role="tab" aria-controls="estudantes" aria-selected="false">
                        <div class="col">
                            <i class="fas fa-user mr-2"></i>
                            Estudantes
                        </div>
                    </a>
                @endif

                @if (Auth::user()->tipo == "admin")
                    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="contactos-tab" data-toggle="tab" href="#contactos" role="tab" aria-controls="contactos" aria-selected="false">
                        <div class="col"><i class="fas fa-address-book mr-2"></i>Lista telefónica</div>
                    </a>
                @endif

                <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link border" id="observacoes-tab" data-toggle="tab" href="#observacoes" role="tab" aria-controls="observacoes" aria-selected="false">
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
                                <div class="col border rounded bg-light shadow-sm  m-2 mt-4 p-3" style="min-width: 320px; max-width: 320px; height:auto; max-height:240px; color:black !important">
                                    <div class="row p-0 m-0" style="margin-top:-30px!important">
                                        <div class="col text-right p-0">
                                            @if (Auth::user()->tipo == "admin")
                                                <form method="POST" role="form" id="#" action="{{route('agenda.destroy',$agenda)}}" class="d-inline-block form_university_event" data="{{$agenda->titulo}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete_event_btn shadow-sm text-center btn_list_opt btn_delete mr-2" title="Eliminar Evento" data-toggle="modal" data-target="#exampleModal">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-2"><i class="fas fa-square mr-2" title="{{$agenda->titulo}}" style="color:{{$agenda->cor}}"></i>Evento:
                                        <strong>{{ \Illuminate\Support\Str::limit($agenda->titulo, 50, $end=' (...)') }}</strong>
                                    </div>

                                    <div class="mt-3">
                                        {{ \Illuminate\Support\Str::limit($agenda->descricao, 70, $end=' (...)') }}
                                    </div>

                                    <div class="row">
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
                                <div class="text-muted"><small>(sem dados para apresentar)</small></div>
                            </div>
                        @endif
                    </div>

                    {{-- Lista de estudantes --}}
                    @if (Auth::user()->tipo == "admin")
                    <div class="tab-pane fade" id="estudantes" role="tabpanel" aria-labelledby="estudantes-tab">
                        @if($clients)
                        <div class="table-responsive">
                            <table id="table" class="display table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Referência</th>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th style="max-width:50px; min-width:50px;">Estado</th>
                                        <th style="max-width:50px; min-width:50px;">Opções</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($clients as $client)
                                    <tr class="font-weight-normal">
                                        <td>{{$client->refCliente}}</td>
                                        <td>{{$client->nome.' '.$client->apelido}}</td>
                                        <td>
                                            @if ($client->telefone1)
                                                {{$client->telefone1}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($client->estado == "Ativo")
                                                <span class="text-success font-weight-bold">Ativo</span>
                                            @elseif ($client->estado == "Inativo")
                                                <span class="text-danger font-weight-bold">Inativo</span>
                                            @else
                                                <span class="text-info font-weight-bold">Proponente</span>
                                            @endif
                                        </td>

                                        <td class="text-center align-middle">
                                            <a href="{{route('clients.show',$client)}}" class="btn btn-sm btn-outline-primary" title="Ver ficha completa"><i class="far fa-eye"></i></a>
                                            @if (Auth::user()->tipo == "admin")
                                                <a href="{{route('clients.edit',$client)}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <div class="border rounded bg-light p-3">
                                <div class="text-muted">
                                    <small>(sem dados para apresentar)</small>
                                </div>
                            </div>
                        @endif
                    </div>
                    @endif

                    {{-- Lista de contactos --}}
                    @if (Auth::user()->tipo == "admin")
                        <div class="tab-pane fade" id="contactos" role="tabpanel" aria-labelledby="contactos-tab">
                            @if ($contacts)
                                <div class="table-responsive">
                                    <table id="tableContactos" class="display table table-bordered table-striped " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>E-mail</th>
                                                <th>Telefone</th>
                                                <th style="max-width:50px; min-width:50px;">Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contacts as $contact)
                                            <tr>
                                                <td>
                                                    @if($contact->favorito)
                                                        <i class="fas fa-star text-warning mr-1" title="Contacto favorito" style="font-size:12px"></i>
                                                    @endif
                                                    {{$contact->nome}}
                                                </td>
                                                <td>
                                                    @if ($contact->email)
                                                        {{$contact->email}}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{$contact->telefone1}}</td>

                                                <td class="text-center align-middle">
                                                    <a href="{{route('contacts.show', [$contact,$university])}}" class="btn btn-sm btn-outline-primary" title="Ver ficha completa"><i class="far fa-eye"></i></a>
                                                    <a href="{{route('contacts.edit', [$contact,$university])}}" class="btn btn-sm btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                    <form method="POST" role="form" id="{{ $contact->idContacto }}" action="{{route('contacts.destroy',$contact)}}" data="{{ $contact->nome }}" class="d-inline-block form_contact_id">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar contacto" data-toggle="modal" data-target="#staticBackdrop">
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

                    <div class="tab-pane fade text-gray-900" id="observacoes" role="tabpanel" aria-labelledby="observacoes-tab">
                        <div class="mb-2 font-weight-bold">Observações gerais:</div>
                        <div class="border rounded bg-light p-3">
                            @if ($university->observacoes)
                                <span>{{$university->observacoes}}</span>
                            @else
                                <div class="text-muted">
                                    <small>(sem dados para mostrar)</small>
                                </div>
                            @endif
                        </div>
                        <br>
                        <div class="mb-2 font-weight-bold">Observação dos Candidaturas:</div>
                        <div class="border rounded bg-light p-3">
                            @if ($university->obsCandidaturas)
                                <span>{{$university->obsCandidaturas}}</span>
                            @else
                                <div class="text-muted">
                                    <small>(sem dados para mostrar)</small>
                                </div>
                            @endif
                        </div>
                        <br>
                        <div class="mb-2 font-weight-bold">Observação dos Cursos:</div>
                        <div class="border rounded bg-light p-3">
                            @if ($university->obsCursos)
                                <span>{{$university->obsCursos}}</span>
                            @else
                                <div class="text-muted">
                                    <small>(sem dados para mostrar)</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of container-fluid -->

<!-- Modal Info -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Para que serve?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-gray-800 pl-4 pr-5">
                Aqui apenas pode visualizar os detalhes da universidade. Para editar os dados da universidade, clique no botão <b>Editar universidade</b>.
            </div>
            <div class="modal-footer mt-3">
                <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                <button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Info -->

<!-- Begin of Scripts -->
@section('scripts')
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            "language": {
                "sEmptyTable": "Não foi encontrado nenhum registo",
                "sLoadingRecords": "A carregar...",
                "sProcessing": "A processar...",
                "sLengthMenu": "Mostrar _MENU_ registos",
                "sZeroRecords": "Não foram encontrados resultados",
                "sInfo": "Mostrando _END_ de _TOTAL_ registos",
                "sInfoEmpty": "Mostrando de 0 de 0 registos",
                "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
                "sInfoPostFix": "",
                "sSearch": "Procurar:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext": "Seguinte",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "order": [1, 'asc']
        });

        $('#tableContactos').DataTable({
            "language": {
                "sEmptyTable": "Não foi encontrado nenhum registo",
                "sLoadingRecords": "A carregar...",
                "sProcessing": "A processar...",
                "sLengthMenu": "Mostrar _MENU_ registos",
                "sZeroRecords": "Não foram encontrados resultados",
                "sInfo": "Mostrando _END_ de _TOTAL_ registos",
                "sInfoEmpty": "Mostrando de 0 de 0 registos",
                "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
                "sInfoPostFix": "",
                "sSearch": "Procurar:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext": "Seguinte",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "order": [0, 'asc']
        });

        bsCustomFileInput.init();
        $(".needs-validation").submit(function(event) {
            if (this.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                $("#cancelBtn").removeAttr("onclick");
                button =
                    "<button class='btn btn-primary' type='submit' disabled><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='position:relative; bottom:4px; right:3px;'></span>A fazer o registo...</button>";
                $("#groupBtn").append(button);
                $("#submitbtn").remove();
            }
            $(".needs-validation").addClass("was-validated");
        });

        var options = [
            {"option": document.getElementById("eventos-tab")},
            {"option": document.getElementById("estudantes-tab")},
            {"option": document.getElementById("contactos-tab")},
            {"option": document.getElementById("observacoes-tab")}
        ]

        $("#eventos-tab, #estudantes-tab, #contactos-tab, #observacoes-tab").click(function(){
            for (var i = 0; i < options.length; i++) {
                if(this.id === options[i].option.id){
                    $(this).removeClass("bg-white").addClass("bg-primary text-white");
                }else{
                    $(options[i].option).removeClass("bg-primary text-white").addClass("bg-white");
                }
            }
        });
    });
</script>
@endsection
<!-- End of Scripts -->
@endsection
<!-- End of Page Content -->
