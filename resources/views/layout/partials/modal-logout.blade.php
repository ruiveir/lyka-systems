<!-- Modal Logout -->
<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Já se vai embora?</h5>
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
