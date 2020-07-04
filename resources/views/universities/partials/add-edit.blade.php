<div class="alert alert-danger mb-3" id="warning_msg" style="display: none">
    <i class="fas fa-exclamation-triangle mr-2"></i>Existem dados obrigatórios por preencher. Verifique os campos
    assinalados.
</div>


<div class="row nav nav-fill w-100 text-center mx-auto p-3 ">

    <a class="nav-item nav-link active border p-3 m-1 bg-white rounded shadow-sm name_link" id="infos-tab"
        data-toggle="tab" href="#infos" role="tab" aria-controls="infos-tab" aria-selected="true">
        <div class="col"><i class="fas fa-university mr-2"></i>Informações</div>
    </a>

    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm name_link" id="observacoes-tab"
        data-toggle="tab" href="#observacoes" role="tab" aria-controls="observacoes" aria-selected="false">
        <div class="col"><i class="fas fa-pencil-alt mr-2"></i>Observações</div>
    </a>

</div>





<div class="bg-white shadow-sm mb-4 p-4 border" style="margin-top:-30px">

    <div class="tab-content p-2 mt-3" id="myTabContent">


        {{-- Conteudo: Informações --}}
        <div class="tab-pane fade show active" id="infos" role="tabpanel" aria-labelledby="infos-tab">

            {{-- INPUT nome --}}
            <label for="inputNome" style="font-weight: 700!important;">Nome da Universidade:</label>
            <input required type="text" class="form-control" name="nome" id="inputNome"
                placeholder="Insira o nome da Universidade" value="{{old('nome',$university->nome)}}" maxlength="250" />

            <br>

            {{-- INPUT morada --}}
            <label for="inputMorada" style="font-weight: 700!important;">Morada:</label>
            <input type="text" class="form-control" name="morada" id="inputMorada"
                placeholder="Insira a morada da universidade" value="{{old('morada',$university->morada)}}"
                maxlength="250" />

            <br>

            <div class="row">
                <div class="col">
                    {{-- INPUT e-mail --}}
                    <label for="inputEmail" style="font-weight: 700!important;">E-mail:</label>
                    <input required type="email" class="form-control" name="email" id="inputEmail"
                        value="{{old('email',$university->email)}}" maxlength="250" title="Inisira um e-mail válido" />
                </div>

                <div class="col">
                    {{-- INPUT telefone --}}
                    <label for="inputTelefone" style="font-weight: 700!important;">Telefone:</label>
                    <input type="text" class="form-control" name="telefone" id="inputTelefone"
                        value="{{old('telefone',$university->telefone)}}" maxlength="20" />
                </div>
            </div>

            <br>


            <div class="row">

                <div class="col">
                    <label for="inputNIF" style="font-weight: 700!important;">NIF:</label>
                    <input required type="text" class="form-control" name="NIF" id="inputNIF"
                        value="{{old('NIF',$university->NIF)}}" maxlength="20" />
                </div>

                <div class="col">
                    {{-- INPUT IBAN --}}
                    <label for="inputIBAN" style="font-weight: 700!important;">IBAN:</label>
                    <input type="text" class="form-control " name="IBAN" id="inputIBAN"
                        value="{{old('IBAN',$university->IBAN)}}" maxlength="25" />
                </div>

            </div>


        </div>



        {{-- Conteudo: Observações --}}
        <div class="tab-pane fade" id="observacoes" role="tabpanel" aria-labelledby="observacoes-tab">

            <label for="inputObservacoes" style="font-weight: 700!important;">Observações gerais:</label>
            <textarea name="observacoes" id="inputObservacoes" rows="4"
                class="form-control select_style">{{old('observacoes',$university->observacoes)}}</textarea>

            <br>

            <label for="inputObsCursos" style="font-weight: 700!important;">Observações de Cursos:</label>
            <textarea name="obsCursos" id="inputObsCursos" rows="4"
                class="form-control select_style">{{old('obsCursos',$university->obsCursos)}}</textarea>

            <br>

            <label for="inputObsCandidaturas" style="font-weight: 700!important;">Observações de
                Candidaturas:</label>
            <textarea name="obsCandidaturas" id="inputObsCandidaturas" rows="4"
                class="form-control select_style">{{old('obsCandidaturas',$university->obsCandidaturas)}}</textarea>


        </div>





    </div>
</div>
