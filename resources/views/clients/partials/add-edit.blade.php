<div class="container-fluid">
    @if (Auth::user()->tipo == "admin")
    <div class="form-row mb-3">
        @php
            // Referência do cliente sem o seu ID
            if ($client->refCliente) {
                $refClient = substr($client->refCliente, 0, -4);
            }
        @endphp
        <div class="col-md-3 col-sm-4 mb-3">
            <label for="refCliente" class="text-gray-900">Referência do estudante <sup class="text-danger small">&#10033;</sup></label>
            <input type="text" class="form-control" name="refCliente" id="refCliente" placeholder="Inserir uma referência..." value="@if(isset($refClient)){{$refClient}}@endif" maxlength="5" required>
            <div class="invalid-feedback">
                Oops, parece que algo não está bem...
            </div>
        </div>
        <div class="col-md-3 col-sm-4 mb-3">
            <label for="estado" class="text-gray-900">Estado do cliente <sup class="text-danger small">&#10033;</sup> </label>
            <select class="custom-select" id="estado" name="estado" required>
                <option selected disabled hidden>Escolher estado do cliente...</option>
                <option {{old('idAgente', $client->estado ) == "Proponente" ? "selected" : "" }} value="Proponente">Proponente</option>
                <option {{old('idAgente', $client->estado ) == "Ativo" ? "selected" : "" }} value="Ativo">Ativo</option>
                <option {{old('idAgente', $client->estado ) == "Inativo" ? "selected" : "" }} value="Inativo">Inativo</option>
            </select>
            <div class="invalid-feedback">
                Oops, parece que algo não está bem...
            </div>
        </div>
        <div class="col-md-3 col-sm-4 mb-3">
            <label for="idAgente" class="text-gray-900">Agente responsável</label>
            <select class="custom-select" id="idAgente" name="idAgente">
                <option selected disabled hidden>Escolher agente...</option>
                @if($agents)
                    @foreach($agents as $agent)
                        <option value="{{$agent->idAgente}}" {{old('idAgente', $client->idAgente ) == $agent->idAgente ? "selected" : "" }}   >{{$agent->nome.' '.$agent->apelido}} ({{$agent->pais}})</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-3 col-sm-4 mb-3">
            <label for="idSubAgente" class="text-gray-900">Subagente responsável</label>
            <select class="custom-select" id="idSubAgente" name="idSubAgente">
                <option selected disabled hidden>Escolher subagente...</option>
                @if($subAgentes)
                    @foreach($subAgentes as $subAgente)
                        <option value="{{$subAgente->idAgente}}" {{old('idSubAgente', $client->idSubAgente ) == $subAgente->idAgente ? "selected" : "" }}>{{$subAgente->nome.' '.$subAgente->apelido.' ('.$subAgente->pais.')'}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    @else
        <input type="hidden" id="idAgente" name="idAgente" value="{{old('idAgente', $client->idAgente)}}">
        <input type="hidden" id="estado" value="{{old('estado', $client->estado)}}">
    @endif
</div>

<div class="row nav nav-fill w-100 text-center mx-auto p-3">
    <a class="nav-item nav-link active border p-3 m-1 bg-primary text-white rounded shadow-sm" id="pessoal-tab" data-toggle="tab" href="#pessoal" role="tab" aria-controls="pessoal" aria-selected="true">
        <div class="col">
            <i class="fas fa-user mr-2"></i>Dados pessoais
        </div>
    </a>

    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab" aria-controls="documentation" aria-selected="false">
        <div class="col">
            <i class="far fa-id-card mr-2"></i>Documentos
        </div>
    </a>

    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm" id="academicos-tab" data-toggle="tab" href="#school" role="tab" aria-controls="school" aria-selected="false">
        <div class="col" style="min-width: 197px">
            <i class="fas fa-graduation-cap mr-2"></i>Dados académicos
        </div>
    </a>

    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">
        <div class="col">
            <i class="fas fa-comments mr-2"></i>Contactos
        </div>
    </a>

    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm border" id="financas-tab" data-toggle="tab" href="#financas" role="tab" aria-controls="financas" aria-selected="false">
        <div class="col"><i class="fas fa-chart-pie mr-2"></i>Financeiro</div>
    </a>
</div>

<div class="bg-white border shadow-sm mb-4 p-4" style="margin-top:-30px">
    <div class="tab-content p-2 mt-3" id="myTabContent">
        {{-- Conteudo: Informação pessoal --}}
        <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
            <div class="form-row mb-3">
                <div class="col-md-4 mb-3">
                    <label for="nome" class="text-gray-900">Nome próprio <sup class="text-danger small">&#10033;</sup> </label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Inserir uma nome..." value="{{old('nome', $client->nome)}}" required>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="apelido" class="text-gray-900">Apelido <sup class="text-danger small">&#10033;</sup> </label>
                    <input type="text" class="form-control" name="apelido" id="apelido" placeholder="Inserir uma apelido..." value="{{old('apelido', $client->apelido)}}" required>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="fotografia" class="text-gray-900">Fotografia</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="fotografia" id="fotografia">
                        @if ($client->fotografia)
                            <small class="form-text text-muted" id="removePhoto">Clique para remover a fotografia atual.</small>
                            <label class="custom-file-label" for="fotografia" data-browse="Escolher" id="labelPhoto">{{$client->fotografia}}</label>
                            <input type="text" name="deletePhoto" id="deletePhoto" hidden>
                        @else
                            <small class="form-text text-muted">A fotografia não deve ultrupassar os 5MB.</small>
                            <label class="custom-file-label" for="fotografia" data-browse="Escolher">Escolher fotografia...</label>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-row mb-3">
                <div class="col-md-4 mb-3">
                    <label for="genero" class="text-gray-900">Género <sup class="text-danger small">&#10033;</sup> </label>
                    <select class="custom-select" id="genero" name="genero" required>
                        <option selected disabled hidden>Escolher o género...</option>
                        <option {{old('genero',$client->genero)=='F'?"selected":""}} value="F">Feminino</option>
                        <option {{old('genero',$client->genero)=='M'?"selected":""}} value="M">Masculino</option>
                    </select>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="paisNaturalidade" class="text-gray-900">País de naturalidade <sup class="text-danger small">&#10033;</sup> </label>
                    <select class="custom-select" id="paisNaturalidade" name="paisNaturalidade" required>
                        @if ($client->paisNaturalidade)
                            <option selected hidden value="{{$client->paisNaturalidade}}">{{$client->paisNaturalidade}}</option>
                        @else
                            <option selected hidden value="">Selecione um país...</option>
                        @endif
                        @include('clients.partials.countries')
                    </select>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="dataNasc" class="text-gray-900">Data de nascimento</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="dataNasc" id="dataNasc" value="{{old('dataNasc',$client->dataNasc)}}">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Campo de Observações para o admin --}}
            @if (Auth::user()->tipo == "admin")
                <div class="form-row mb-3">
                    <div class="col mb-3">
                        <label for="obsPessoais" class="text-gray-900">Observações pessoais</label>
                        <textarea class="form-control" name="obsPessoais" id="obsPessoais" rows="2" placeholder="Inserir uma observação...">{{old('obsPessoais',$client->obsPessoais)}}</textarea>
                        <small class="form-text text-muted">Atenção! Visível apenas para o administrador.</small>
                    </div>
                </div>
            @endif

            <div class="form-row mb-3">
                <div class="col mb-3">
                    <label for="obsAgente" class="text-gray-900">Observações gerais</label>
                    <textarea class="form-control" name="obsAgente" id="obsAgente" rows="2" placeholder="Inserir uma observação...">{{old('obsAgente',$client->obsAgente)}}</textarea>
                    <small class="form-text text-muted">Atenção! Visível para o administrador e para o agente.</small>
                </div>
            </div>
        </div>

        {{-- Conteudo: Documentação --}}
        <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">
            {{-- num_docOficial --}}
            <div class="form-row mb-1">
                <div class="col-md-6 mb-3">
                    <label for="img_docOficial" class="text-gray-900">Documento de identificação pessoal</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="img_docOficial" id="img_docOficial" accept="application/pdf, image/*">
                        <small class="form-text text-muted">O documento não deve ultrupassar os 5MB.</small>
                        <label class="custom-file-label" for="img_docOficial" data-browse="Escolher">Escolher documento...</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validade_docOficial" class="text-gray-900">Data de validade</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="validade_docOficial" id="validade_docOficial" value="{{$client->validade_docOficial}}">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col-md-6 mb-3">
                    <label for="num_docOficial" class="text-gray-900">Número de identificação pessoal</label>
                    <input type="text" class="form-control" name="num_docOficial" id="num_docOficial" placeholder="Inserir um número de identificação..." value="{{old('num_docOficial', $client->num_docOficial)}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="NIF" class="text-gray-900">Número de identificação fiscal</label>
                    <input type="text" class="form-control" name="NIF" id="NIF" placeholder="Inserir um NIF..." value="{{old('NIF',$client->NIF)}}">
                </div>
            </div>
            <hr>
            <div class="form-row mb-3 mt-4">
                <div class="col-md-6 mb-3">
                    <label for="img_Passaporte" class="text-gray-900">Passaporte</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="img_Passaporte" id="img_Passaporte" accept="application/pdf, image/*">
                        <small class="form-text text-muted">O passaporte não deve ultrupassar os 5MB.</small>
                        <label class="custom-file-label" for="img_Passaporte" data-browse="Escolher">Escolher passaporte...</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="dataValidPP" class="text-gray-900">Data de validade do passaporte</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="dataValidPP" id="dataValidPP">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row mb-3 mt-3">
                <div class="col-md-4 mb-3">
                    <label for="numPassaporte" class="text-gray-900">Número do passaporte</label>
                    <input type="text" class="form-control" name="numPassaporte" id="numPassaporte" placeholder="Inserir um número de passaporte..." value="{{old('numPassaporte', $client->numPassaporte)}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="passaportPaisEmi" class="text-gray-900">País emissor do passaporte</label>
                    <input type="hidden" id="hidden_passaportPaisEmi" value="{{$passaporteData->passaportPaisEmi ?? ''}}">
                    <select class="custom-select" id="passaportPaisEmi" name="passaportPaisEmi">
                        @include('clients.partials.countries')
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="localEmissaoPP" class="text-gray-900">Local de emissão do passaporte</label>
                    <input type="text" class="form-control" name="localEmissaoPP" id="localEmissaoPP" placeholder="Inserir um local..." value="{{$passaporteData->localEmissaoPP ?? ''}}">
                </div>
            </div>
        </div>

        {{-- Conteudo: Dados académicos --}}
        <div class="tab-pane fade" id="school" role="tabpanel" aria-labelledby="school-tab">
            <div class="form-row mb-3">
                <div class="col-md-4 mb-3">
                    <label for="nivEstudoAtual" class="text-gray-900">Nível de estudos atual</label>
                    <select class="custom-select" id="nivEstudoAtual" name="nivEstudoAtual">
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)==null?"selected":""}} value="0" selected hidden>Selecione um nível...</option>
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='Secundário Incompleto'?"selected":""}} value="Secundário Incompleto">Secundário Incompleto</option>
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='Secundário Completo'?"selected":""}} value="Secundário Completo">Secundário Completo</option>
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='Curso Tecnológico'?"selected":""}} value="Curso Tecnológico">Curso Tecnológico</option>
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='Estuda na Universidade'?"selected":""}} value="Estuda na Universidade">Estuda na Universidade</option>
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='Licenciado'?"selected":""}} value="Licenciado">Licenciado</option>
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='Mestrado'?"selected":""}} value="Mestrado">Mestrado</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="nomeInstituicaoOrigem" class="text-gray-900">Instituição de origem</label>
                    <input class="form-control" type="text" list="institutos" name="nomeInstituicaoOrigem" id="nomeInstituicaoOrigem" placeholder="Inserir uma instituição...">
                    <datalist id="institutos">
                        @if(!empty($instituicoes))
                            @foreach ($instituicoes as $instituicao)
                                <option {{old('nomeInstituicaoOrigem', $client->nomeInstituicaoOrigem ) == $instituicao ? "selected" : "" }} value="{{$instituicao}}" >{{$instituicao}}</option>
                            @endforeach
                        @endif
                    </datalist>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="cidadeInstituicaoOrigem" class="text-gray-900">Cidade da instituição</label>
                    <input class="form-control" type="text" list="cidadeInstituicao" name="cidadeInstituicaoOrigem" id="cidadeInstituicaoOrigem" placeholder="Inserir uma cidade...">
                    <datalist id="cidadeInstituicao">
                        @if(!empty($cidadesInstituicoes) )
                            @foreach ($cidadesInstituicoes as $cidadesInstituicao)
                                <option {{old('cidadeInstituicaoOrigem', $client->cidadeInstituicaoOrigem ) == $cidadesInstituicao ? "selected" : "" }} value="{{$cidadesInstituicao}}" >{{$cidadesInstituicao}}</option>
                            @endforeach
                        @endif
                    </datalist>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="universidade1" class="text-gray-900">Universidade Principal</label>
                    <input class="form-control" type="text" list="institutos" name="universidade1" id="universidade1" placeholder="Inserir uma universidade..." value="{{old('universidade1', $client->universidade1)}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="universidade2" class="text-gray-900">Universidade Secundária</label>
                    <input class="form-control" type="text" list="cidadeInstituicao" name="universidade2" id="universidade2" placeholder="Inserir uma universidade..." value="{{old('universidade2', $client->universidade2)}}">
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-4 mb-3">
                    <label for="curso1" class="text-gray-900">Curso #1</label>
                    <input class="form-control" type="text" list="institutos" name="curso1" id="curso1" placeholder="Inserir um curso..." value="{{old('curso1', $client->curso1)}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="curso2" class="text-gray-900">Curso #2</label>
                    <input class="form-control" type="text" list="cidadeInstituicao" name="curso2" id="curso2" placeholder="Inserir um curso..." value="{{old('curso2', $client->curso2)}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="curso3" class="text-gray-900">Curso #3</label>
                    <input class="form-control" type="text" list="cidadeInstituicao" name="curso3" id="curso3" placeholder="Inserir um curso..." value="{{old('curso3', $client->curso3)}}">
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col-md-12 mb-3">
                    <label for="obsAcademicas" class="text-gray-900">Observações académicas</label>
                    <textarea class="form-control" name="obsAcademicas" id="obsAcademicas" rows="3" placeholder="Inserir uma observação...">{{old('obsAcademicas',$client->obsAcademicas)}}</textarea>
                </div>
            </div>
        </div>

        {{-- Conteudo: Contactos --}}
        <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <div class="form-row mb-4">
                <div class="col-md-4 mb-3">
                    <label for="telefone1" class="text-gray-900">Telefone principal</label>
                    <input type="text" class="form-control" name="telefone1" id="telefone1" placeholder="Inserir um número..." value="{{old('telefone1', $client->telefone1)}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="telefone2" class="text-gray-900">Telefone secundário</label>
                    <input type="text" class="form-control" name="telefone2" id="telefone2" placeholder="Inserir um número..." value="{{old('telefone2',$client->telefone2)}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="email" class="text-gray-900">Endereço eletrónico</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Inserir um e-mail..." value="{{old('email',$client->email)}}">
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col-md-4 mb-3">
                    <label for="moradaResidencia" class="text-gray-900">Morada de residência em Portugal</label>
                    <input type="text" class="form-control" name="moradaResidencia" id="moradaResidencia" placeholder="Inserir uma morada..." value="{{old('moradaResidencia',$client->moradaResidencia)}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="morada" class="text-gray-900">Morada do país de origem</label>
                    <input type="text" class="form-control" name="morada" id="morada" placeholder="Inserir uma morada..." value="{{old('morada',$client->morada)}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="cidade" class="text-gray-900">Cidade de origem</label>
                    <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Inserir uma cidade..." value="{{old('cidade',$client->cidade)}}">
                </div>
            </div>
            <hr>
            <div class="form-row mb-4 mt-4">
                <div class="col-md-4 mb-3">
                    <label for="nomePai" class="text-gray-900">Nome do pai</label>
                    <input type="text" class="form-control" name="nomePai" id="nomePai" placeholder="Inserir um nome..." value="{{old('nomePai',$client->nomePai)}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="telefonePai" class="text-gray-900">Telefone do pai</label>
                    <input type="text" class="form-control" name="telefonePai" id="telefonePai" placeholder="Inserir um número..." value="{{old('telefonePai',$client->telefonePai)}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="emailPai" class="text-gray-900">Endereço eletrónico do pai</label>
                    <input type="email" class="form-control" name="emailPai" id="emailPai" placeholder="Inserir um e-mail..." value="{{old('emailPai',$client->emailPai)}}">
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col-md-4 mb-3">
                    <label for="nomeMae" class="text-gray-900">Nome da mãe</label>
                    <input type="text" class="form-control" name="nomeMae" id="nomeMae" placeholder="Inserir um nome..." value="{{old('nomeMae',$client->nomeMae)}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="telefoneMae" class="text-gray-900">Telefone da mãe</label>
                    <input type="text" class="form-control" name="telefoneMae" id="telefoneMae" placeholder="Inserir um número..." value="{{old('telefoneMae',$client->telefoneMae)}}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="emailMae" class="text-gray-900">Endereço eletrónico da mãe</label>
                    <input type="email" class="form-control" name="emailMae" id="emailMae" placeholder="Inserir um e-mail..." value="{{old('emailMae',$client->emailMae)}}">
                </div>
            </div>
        </div>

        {{-- Conteudo: Financas --}}
        <div class="tab-pane fade" id="financas" role="tabpanel" aria-labelledby="financas-tab">
            <div class="form-row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="IBAN" class="text-gray-900">IBAN (International Account Number)</label>
                    <input type="text" class="form-control" name="IBAN" id="IBAN" placeholder="Inserir um IBAN..." value="{{old('IBAN',$client->IBAN)}}">
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col-md-12 mb-3">
                    <label for="obsFinanceiras" class="text-gray-900">Observações financeiras</label>
                    <textarea class="form-control" name="obsFinanceiras" id="obsFinanceiras" rows="3" placeholder="Inserir uma observação...">{{old('obsFinanceiras',$client->obsFinanceiras)}}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-right mt-3" id="groupBtn">
    <span class="mr-4 font-weight-bold" onclick="window.history.back();" id="cancelBtn" style="cursor:pointer;">Cancelar</span>
    <button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Registar estudante</button>
</div>
