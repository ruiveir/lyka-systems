<div class="modal fade modal-style" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#dc3545;">
                <div class="row">
                    <div class="ml-3">
                        Terminar sessão
                    </div>
                    <div class="ml-auto mr-3">
                        <ion-icon name="close" id="close-icon-modal" data-dismiss="modal"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <span>Tem a certeza que deseja terminar sessão?<br><strong>Todos os dados que não foram gravados, serão perdidos.</strong></span><br><br>
            </div>
            <div class="modal-footer">
                <a href="{{ route('logout') }}" class="top-button btn_submit bg-danger">Sim, terminar sessão
                </a>
                <button type="button" class="top-button bg-secondary mr-2" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
