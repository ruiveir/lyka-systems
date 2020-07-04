<style media="screen">
    #modalContacts select,
    #modalContacts input {
        width: 100%;
        border: none;
        color: #747474;
        font-weight: 600;
        appearance: none;
        padding: 7px 12px;
        border-radius: 5px;
        -moz-appearance: none;
        -webkit-appearance: none;
        background-color: #EAEAEA;
        transition: 0.3s ease-in-out;
    }

    #modalContacts select {
        cursor: pointer;
    }

    #modalContacts select:focus,
    #modalContacts input:focus {
        outline: 0;
        color: #495057;
        border-color: #80bdff;
        background-color: #fff;
        box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
    }

    #modalContacts #error {
        color: #e3342f;
        font-size: 10pt;
        display: inherit;
        margin-bottom: 10px;
    }

    #modalContacts p {
        font-weight: 700;
        margin-bottom: 0;
    }

    #modalContacts .charge-div {
        margin-top: 20px;
        padding: 12px 10px;
        border-radius: 10px;
        background-color: #fff;
        transition: 0.1s ease-in-out;
    }

    #modalContacts .charge-div:hover {
        background-color: rgb(235, 235, 235);
    }

    #modalContacts .white-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: white;
    }

    #modalContacts .white-circle img {
        border-radius: 50%;
    }

    #modalContacts a {
        color: #747474;
    }

    #modalContacts a:hover {
        color: #747474;
        text-decoration: none;
    }

    #modalContacts, .modal-footer {
        border: 0px !important;
    }

    #modalContacts #modalLabel {
        color: #3c3c3c;
        font-weight: 700;
    }

    #modalContacts #a-close-modal {
        font-weight: 700;
        cursor: pointer;
        color: #3c3c3c;
        top: 1px;
        position: relative;
        transition: 0.5s ease-in-out;
    }

    #modalContacts #submit-button {
        background-color: #6A74C9;
        color: white;
        font-weight: 600;
        border-radius: 0px;
    }

    #modalContacts #submit-button:focus {
        box-shadow: none;
        border-radius: 0px;
    }
</style>

<div class="modal modal-style fade bd-example-modal-lg" id="modalContacts" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding-bottom:0px;">
                <div class="row">
                    <div class="ml-3">
                        Procura de contactos
                    </div>
                    <div class="ml-auto mr-3">
                        <ion-icon name="close" id="close-icon-modal" data-dismiss="modal"></ion-icon>
                    </div>
                </div>
            </div>
            <form id="form-contact" method="POST" class="mt-2">
                <div class="modal-body" id="modal-body-contact">
                    <div class="row" id="contact-row">
                        <div class="col-md-4">
                            <label for="user-type">Tipo de contacto:</label>
                            <br>
                            <select id="user-type" name="usertype">
                                <option disabled hidden selected>Escolher tipo de utilizador</option>
                                <option value="clientes">Clientes</option>
                                <option value="agentes">Agentes</option>
                                <option value="universidades">Universidades</option>
                                <option value="fornecedores">Fornecedores</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="a-close-modal" class="mr-4" data-dismiss="modal">Fechar</a>
                    <button id="submit-button" type="submit" class="btn">Procurar contacto</button>
                </div>
            </form>
        </div>
    </div>
</div>
