@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Lista de administradores')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')

<div class="container mt-2">
    <div class="float-left buttons">
        <a href="javascript:history.go(-1)" title="Voltar">
            <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
        </a>
        <a href="javascript:window.history.forward();" title="Avançar">
            <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
        </a>
    </div>
    <div class="float-right">
        <a href="{{route('users.create')}}" class="top-button">Adicionar Administrador</a>
    </div>

    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <div>
                <h6>Listagem de administradores</h6>
            </div>
        </div>


        <br>


        <div class="bg-white shadow-sm mb-4 p-4 " style="border-radius:10px;">
            <div class="row mx-1">
                <div class="col col-2" style="max-width: 120px">
                    <i class="fas fa-user-cog active" style="font-size:80px"></i>
                </div>
                <div class="col">
                    <div class="text-secondary"><strong>Estão registados no sistema {{$users->count()}} administradores</strong></div>
                    <br>
            {{-- Input de procura nos resultados da dataTable --}}

                    <div style="width: 100%; border-radius:10px;">
                        <input type="text" class="shadow-sm" id="customSearchBox"
                            placeholder="Procurar nos resultados..." aria-label="Procurar">

            </div>
                </div>
            </div>


            <br>

            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover " style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center align-content-center">Foto</th>
                        <th>Nome</th>
                        <th>Estado</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="align-middle mx-auto shadow-sm rounded bg-white" style="overflow:hidden; width:50px; height:50px">
                              @if($user->admin->fotografia)
                                  <img src="{{Storage::disk('public')->url('admin-photos/').$user->admin->fotografia}}" width="100%" class="mx-auto">
                              @elseif($user->admin->genero == 'F')
                                  <img src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" width="100%" class="mx-auto">
                              @else
                                  <img src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" width="100%" class="mx-auto">
                              @endif
                            </div>
                        </td>

                        <td class="align-middle"><a href="{{route('users.show', $user)}}" class="name_link " title="Ver ficha completa">{{$user->admin->nome.' '.$user->admin->apelido}}</a></td>
                        <td class="align-middle">@if($user->estado == true) Ativo @else Inativo @endif</td>

                        <td class="text-center align-middle">
                            <a href="{{route('users.show', $user)}}" class="btn_list_opt " title="Ver ficha completa"><i class="far fa-eye mr-2"></i></a>
                            <a href="{{route('users.edit', $user)}}" class="btn_list_opt btn_list_opt_edit" title="Editar"><i class="fas fa-pencil-alt mr-2"></i></a>
                            <a href="" class="btn_delete" title="Eliminar agente" data-toggle="modal" data-target="#deleteModal" data-name="{{$user->admin->nome.' '.$user->admin->apelido}}" data-slug="{{$user->slug}}"><i class="fas fa-trash-alt"></i></a>
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar administrador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="POST" action="{{route('users.destroy', $user)}}">
                    @csrf
                    @method('DELETE')
                    <p style="display:inline-block;">Prente eliminar o administrador: <p class="ml-1" id="text" style="font-weight:700; display:inline-block;"></p>?</p>
                    <p style="font-weight:500;">Ao clicar "Sim, eliminar administrador", irá eliminar a conta definitivamente e perder todos os dados associados.</p>
                  </div>
                    <div class="modal-footer">
                        <button class="top-button btn_submit bg-danger" type="submit"><i class="far fa-trash-alt mr-2"></i>Sim, eliminar administrador</button>
                        <button type="button" class="top-button bg-secondary mr-2" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({

            "columnDefs": [{
                    "orderable": false,
                    "width": "60px",
                    "targets": 0
                },
                {
                    "orderable": false,
                    "targets": 2
                },
                {
                    "orderable": false,
                    "width": "130px",
                    "targets": 3
                },

            ],

            "language": {
                "lengthMenu": "Mostrar _MENU_ por página",
                "search": "Procurar",
                "zeroRecords": "Sem registos",
                "paginate": {
                    "first": "Primeiro",
                    "last": "Ultimo",
                    "next": "Seguinte",
                    "previous": "Anterior"
                },

                "info": "",
                "infoEmpty": "",
                "infoFiltered": ""
            },

            "order": [2, 'asc'],
        });


        $(".dataTables_filter").hide();
        $("#customSearchBox").on('keyup', function() {
            $(".dataTables_filter input").val($("#customSearchBox").val())
            table.search($(".dataTables_filter input").val()).draw();
        });

        $('.dataTables_length').hide();
        $('#records_per_page').val(table.page.len());
        $('#records_per_page').change(function() {
            table.page.len($(this).val()).draw();
        });

        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var name = button.data('name');
            var modal = $(this);
            modal.find('#text').text(name);
            modal.find("form").attr('action', '/administradores/' + button.data('slug'));
        });
    });
</script>
@endsection
@endsection
