<div class="modal fade message-modal" id="modal-success" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <ion-icon id="checkmark-icon" name="checkmark" size="large"></ion-icon>
            </div>
            <div class="modal-body text-center">
                <p id="title-modal">Registo feito com sucesso!</p>
                <p id="text-info-modal" class="mt-3">Pretende transferir a nota de pagamento que comprova o pagamento registado?</p>
            </div>
            <div class="modal-footer mt-2">
                <div class="row text-center">
                    <div class="col-6">
                        <a id="cancel-button" href="{{route("payments.index")}}">Voltar</a>
                    </div>
                    <div class="col-6">
                        <a id="anchor-stream" target="_blank">Transferir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
