<div class="modal fade" id="modal-success" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Hurray, o registo foi feito com sucesso 🎉</h5>
            </div>
            <div class="modal-body text-gray-800 pl-4 pr-5">
                Visto que tudo correu bem, a Lyka Systems preparou automaticamente uma nota de pagamento para este pagamento. Clique em <b>Transefir</b> para obtê-la.
            </div>
            <div class="modal-footer mt-3">
                <a href="{{route("payments.index")}}" class="mr-4 font-weight-bold text-gray-700" id="close-option" style="text-decoration:none;">Fechar</a>
                <a id="anchor-stream" target="_blank" class="btn btn-primary font-weight-bold mr-2 text-white">Transferir!</a>
            </div>
        </div>
    </div>
</div>
