<div class="modal fade" id="modalCalendar" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Novo Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="/agenda" method="POST" class="form-group needs-validation pt-3 " novalidate
                  enctype="multipart/form-data" id="formEvent">
                @csrf
                <div class="modal-body">
                    <div class="calendar">
                        <script
                            src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
                    </div>

                    {{-- Para utilização apartir da página show da universidade --}}
                    @if ( isset($university))
                        <div class="row mb-2">
                            <div class="col">
                                <div class="form-group">
                                    {{-- Id da Universidade --}}
                                    <div class="card rounded text-center p-3"><strong><span
                                                class="text-muted">{{$university->nome}}</span></strong></div>
                                    <input type="hidden" name="idUniversidade" value="{{$university->idUniversidade}}">
                                </div>
                            </div>
                        </div>
                    @endif

                    <input type="hidden" name="idAgenda">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <i class="fas fa-pen mr-2" style="color: #6A74C9;"></i>
                                <label for="title">Titulo</label>
                                <input type="text" class="form-control limpar" id="title" name="titulo"
                                       maxlength="100" placeholder="Insira o Titulo do evento." required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <i class="fas fa-palette mr-2" style="color: #6A74C9;"></i>
                                <label for="color">Cor</label>
                                <input type="color" class="form-control limpar" id="color" name="cor" value="#6A74C9">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <i class="far fa-calendar-alt mr-2" style="color: #6A74C9;"></i>
                                <label for="startDate">Data/Hora Inicial</label>
                                <input type="datetime-local" class="form-control limpar" id="startDate"
                                       name="dataInicio" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <i class="far fa-calendar-alt mr-2" style="color: #6A74C9;"></i>
                                <label for="endDate">Data/Hora Final</label>
                                <input type="datetime-local" class="form-control limpar" id="endDate" name="dataFim"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <i class="fas fa-align-right mr-2" style="color: #6A74C9;"></i>
                                <label for="description">Descrição</label>
                                <textarea class="form-control limpar" name="descricao" id="description" rows="2"
                                          style="resize: none"
                                          maxlength="150" placeholder="Insira a Descrição do evento." required
                                          fixed></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="action" value="save" class="top-button mr-2" id="buttonSubmit">Guardar
                    </button>
                    <button type="submit" name="action" value="delete"
                            class="top-button btn_submit bg-danger deleteEvent" style="display: none">Eliminar
                    </button>
                    <button type="button" class="top-button bg-secondary mr-2" id="btnFechar" data-dismiss="modal">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>






<!-- Modal Logout -->
<div class="modal fade" id="modalCalendar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Pretende criar um novo evento?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-gray-800 pl-4 pr-5">
                Pretende mesmo sair? Ao terminar a sua sessão todos os dados que não foram gravados podem ser perdidos. Vale a pena pensar duas vezes!
            </div>
            <div class="modal-footer mt-3">
                <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Cancelar</a>
                <a href="{{route('logout')}}" type="button" class="btn btn-danger font-weight-bold mr-2">Terminar sessão</a>
            </div>
        </div>
    </div>
</div>
