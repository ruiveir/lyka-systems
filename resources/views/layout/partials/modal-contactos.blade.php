<!-- Begin Modal Contacts -->
<div class="modal fade" id="modalContacts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Pretende procurar um contacto?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group needs-validation mb-0" id="form-contact" method="POST" novalidate>
                @csrf
                <div class="modal-body text-gray-800 pl-4 pr-5" id="modal-body">
                    <div class="form-row d-flex justify-content-between mt-2" id="contactos-form-row">
                        <div class="col-md-4">
                            <label for="user-type">Tipo de utilizador <sup class="text-danger small">&#10033;</sup></label>
                            <select id="user-type" class="custom-select" name="usertype" required>
                                <option value="clientes">Clientes</option>
                                <option value="agentes">Agentes</option>
                                <option value="universidades">Universidades</option>
                                <option value="fornecedores">Fornecedores</option>
                            </select>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-1 mt-4 d-none" id="div-table-contactos">
                        <table class="table table-bordered table-striped" id="table-contactos" width="100%">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Telemóvel</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer mt-3" id="groupBtn">
                    <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Cancelar</a>
                    <button id="submitbtn" type="submit" class="btn btn-primary font-weight-bold mr-2">Procurar contacto</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Contacts -->
