<div class="modal fade message-modal" id="modal-error" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <ion-icon id="close-icon" name="close-outline" size="large"></ion-icon>
            </div>
            <div class="modal-body text-center">
                <p id="title-modal">Oops, parece que houve um erro!</p>
                <p id="text-info-modal" class="mt-3">Tente registar o pagamento mais uma vez.<br>Se o problema continuar, por favor, contacte-nos.</p>
            </div>
            <div class="modal-footer mt-2">
                <div class="row text-center">
                    <div class="col-6">
                        <a id="cancel-button" href="{{route("payments.index")}}">Cancelar</a>
                    </div>
                    <div class="col-6">
                        <a id="anchor-stream" data-dismiss="modal">Continuar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
