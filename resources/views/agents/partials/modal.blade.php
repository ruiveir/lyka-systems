<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Agente</h5>


                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Tem a certeza que deseja eliminar o agente: <br><span id="agent_name"></span>?<br><br>
                <strong>Esta pessoa deixará de ter acesso à plataforma.<br><small>Caso existam, os subagentes tambem serão eliminados.</small></strong></span><br><br>
            </div>
            <div class="modal-footer">
                <button type="submit" class="top-button btn_submit bg-danger"><i class="far fa-trash-alt mr-2"></i>Sim,
                    eliminar agente
                </button>
                <button type="button" class="top-button bg-secondary mr-2" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
