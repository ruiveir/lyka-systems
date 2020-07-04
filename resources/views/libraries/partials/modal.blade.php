<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar ficheiro</h5>


                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>Tem a certeza que deseja eliminar este ficheiro:<br><span id="deletefile_name"></span> ?
                    <br><br>
                    <div><strong>Esta ação é irreversível. O ficheiro não poderá ser recuperado!</strong></div>
                </div><br><br>

            </div>
            <div class="modal-footer">
                <button type="submit" class="top-button btn_submit bg-danger"><i class="far fa-trash-alt mr-2"></i>Sim,
                    eliminar ficheiro
                </button>
                <button type="button" class="top-button bg-secondary mr-2" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
