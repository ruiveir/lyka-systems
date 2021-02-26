<div class="row nav nav-fill w-100 text-center mx-auto p-3 ">
    <a class="nav-item nav-link active border p-3 m-1 bg-primary text-white rounded shadow-sm name_link" id="infos-tab" data-toggle="tab" href="#infos" role="tab" aria-controls="infos-tab" aria-selected="true">
        <div class="col">
            <i class="fas fa-university mr-2"></i>Informações
        </div>
    </a>

    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="observacoes-tab" data-toggle="tab" href="#observacoes" role="tab" aria-controls="observacoes" aria-selected="false">
        <div class="col">
            <i class="fas fa-pencil-alt mr-2"></i>Observações
        </div>
    </a>
</div>


<div class="bg-white shadow-sm mb-4 p-4 border" style="margin-top: -30px;">
    <div class="tab-content p-2 mt-3" id="myTabContent">
        <div class="tab-pane fade show active" id="infos" role="tabpanel" aria-labelledby="infos-tab">
            <div class="form-row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="inputNome" class="text-gray-900">Nome da universidade <sup class="text-danger small">&#10033;</sup></label>
                    <input type="text" class="form-control" name="nome" id="inputNome" placeholder="Inserir um nome..." value="{{old('nome', $university->nome)}}" maxlength="250" required>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
            </div>

            <div class="form-row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="inputMorada" class="text-gray-900">Morada</label>
                    <input type="text" class="form-control" name="morada" id="inputMorada" placeholder="Inserir uma morada..." value="{{old('morada', $university->morada)}}" maxlength="250">
                </div>
            </div>

            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="inputEmail" class="text-gray-900">E-mail <sup class="text-danger small">&#10033;</sup></label>
                    <input type="email" class="form-control" name="email" id="inputEmail" value="{{old('email', $university->email)}}" maxlength="250" placeholder="Inserir um e-mail..." required>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputTelefone" class="text-gray-900">Telefone</label>
                    <input type="text" class="form-control" name="telefone" id="inputTelefone" value="{{old('telefone',$university->telefone)}}" placeholder="Inserir um número de telefone..." maxlength="20">
                </div>
            </div>

            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="inputNIF" class="text-gray-900">NIF <sup class="text-danger small">&#10033;</sup></label>
                    <input type="text" class="form-control" name="NIF" id="inputNIF" value="{{old('NIF', $university->NIF)}}" placeholder="Inserir um número NIF..." maxlength="20" required>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputIBAN" class="text-gray-900">IBAN</label>
                    <input type="text" class="form-control" name="IBAN" id="inputIBAN" value="{{old('IBAN', $university->IBAN)}}" placeholder="Inserir um IBAN..." maxlength="25">
                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="observacoes" role="tabpanel" aria-labelledby="observacoes-tab">
            <label for="inputObservacoes" class="text-gray-900">Observações gerais</label>
            <textarea name="observacoes" id="inputObservacoes" rows="4" class="form-control" placeholder="Inserir uma observação geral...">{{old('observacoes', $university->observacoes)}}</textarea>

            <br>

            <label for="inputObsCursos" class="text-gray-900">Observações de cursos</label>
            <textarea name="obsCursos" id="inputObsCursos" rows="4" class="form-control" placeholder="Inserir uma observação de curso...">{{old('obsCursos', $university->obsCursos)}}</textarea>

            <br>

            <label for="inputObsCandidaturas" class="text-gray-900">Observações de candidaturas</label>
            <textarea name="obsCandidaturas" id="inputObsCandidaturas" rows="4" class="form-control" placeholder="Inserir uma observação de candidatura...">{{old('obsCandidaturas', $university->obsCandidaturas)}}</textarea>
        </div>
    </div>
</div>
