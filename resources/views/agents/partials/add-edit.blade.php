<div class="row nav nav-fill w-100 text-center mx-auto p-3">
    <!-- Secção para o TIPO DE AGENTE -->
    <a class="nav-item nav-link border p-3 m-1 bg-primary text-white rounded shadow-sm" id="agent-type-tab" data-toggle="tab" href="#agent_type" role="tab" aria-controls="agent_type" aria-selected="false">
        <div class="col">
            <i class="fas fa-user-tie mr-2"></i>
            <span>Tipo de Agente</span>
        </div>
    </a>

    <!-- Secção para o DADOS PESSOAIS -->
    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="false">
        <div class="col">
            <i class="fas fa-user-edit mr-2"></i>
            <span>Dados pessoais</span>
        </div>
    </a>

    <!-- Secção para o DOCUMENTOS -->
    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">
        <div class="col">
            <i class="far fa-id-card mr-2"></i>
            <span>Documentos</span>
        </div>
    </a>

    <!-- Secção para o CONTACTOS -->
    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">
        <div class="col">
            <i class="fas fa-comments mr-2"></i>
            <span>Contactos</span>
        </div>
    </a>

    <!-- Secção para o FINANCEIRO -->
    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm" id="financas-tab" data-toggle="tab" href="#financas" role="tab" aria-controls="financas" aria-selected="false">
        <div class="col">
            <i class="fas fa-chart-pie mr-2"></i>
            <span>Financeiro</span>
        </div>
    </a>
</div>

<div class="bg-white shadow-sm mb-4 p-4 border" style="margin-top:-30px">
    <div class="tab-content p-2 mt-3" id="myTabContent">
        <!-- Secção para o conteúdo do TIPO DE AGENTE -->
        <div class="tab-pane fade active show font-weight-normal" id="agent_type" role="tabpanel" aria-labelledby="agent_type" style="color: black">
            <div class="row">
                <div class="col col-4 mr-3" style="min-width: 350px">
                    <div>
                        <div class="mb-3">
                            <label for="tipo">Tipo de agente <sup class="text-danger small">&#10033;</sup></label><br>
                            <select id="tipo" name="tipo" class="custom-select" required>
                                <option {{old('tipo',$agent->tipo)=='Agente'?"selected":""}} value="Agente">Agente</option>
                                <option {{old('tipo',$agent->tipo)=='Subagente'?"selected":""}} value="Subagente">Subagente</option>
                            </select>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>
                        <div class="mb-3" id="div_subagente">
                            <label for="subagent">Subagente de... <sup class="text-danger small">&#10033;</sup></label><br>
                            <input type="hidden" id="aux_idAgenteAssociado" value="{{old('idAgenteAssociado', $agent->idAgenteAssociado)}}" required>
                            <select id="idAgenteAssociado" name="idAgenteAssociado" class="custom-select">
                                <option selected disabled hidden value="0">Escolher um sub-agente...</option>
                                @foreach($listagents as $agentx)
                                @if ($agentx->idAgente != $agent->idAgente && $agentx->tipo != "Subagente" )
                                    <option value="{{$agentx->idAgente}}">{{$agentx->nome.' '.$agentx->apelido.' ('.$agentx->pais.')'}}</option>
                                @endif
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Oops, parece que algo não está bem...
                            </div>
                        </div>

                        <div id="div_execao">
                            @if (Auth::user()->tipo == "admin")
                            <label class="checkbox-inline"><input id="checkbox_exepcao" type="checkbox" {{old('exepcao',$agent->exepcao)=='1'?"checked":""}} class="mr-2">Este subagente é uma exceção</label>
                            @endif
                            <input type="hidden" id="exepcao" name="exepcao" value="{{old('exepcao',$agent->exepcao)=='1'?"1":"0"}}">
                        </div>
                    </div>
                </div>

                <div class="col bg-light border rounded p-3 px-4 m-2" style="min-width: 200px">
                    <div class="" id="div_infos_agente">
                        <div class="font-weight-bold">Permissões dos Agentes:</div>
                        <div class="my-3">- Tem acesso à lista dos seus clientes e à dos seus subagentes</div>
                        <div class="my-3">- Tem acesso à lista dos seus subagentes</div>
                    </div>
                    <div class="" id="div_infos_subagente" style="display: none">
                        <div class="font-weight-bold">Permissões dos Subagentes:</div>
                        <div class="my-3">- Apenas tem acesso à lista dos seus clientes</div>
                    </div>
                    <div>
                        <div class="my-3">- Podem carregar documentos nas fichas dos seus clientes</div>
                        <div class="my-3">- Quando autorizados, podem alterar as informações dos seus clientes</div>
                        <div class="my-3">- Têm acesso às notificações públicas</div>
                        <div class="my-3">- Podem visualizar os ficheiros públicos inseridos na biblioteca</div>
                        <div class="my-3">- Têm agenda e lista telefónica privada</div>
                        <div class="mt-3">- Podem utilizar a funcionalidade de "Reportar problema"</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secção para o conteúdo do DADOS PESSOAIS -->
        <div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="nome" class="text-gray-900">Nome próprio <sup class="text-danger small">&#10033;</sup> </label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Inserir uma nome..." value="{{old('nome', $agent->nome)}}" required>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apelido" class="text-gray-900">Apelido <sup class="text-danger small">&#10033;</sup> </label>
                    <input type="text" class="form-control" name="apelido" id="apelido" placeholder="Inserir uma apelido..." value="{{old('apelido', $agent->apelido)}}" required>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="genero" class="text-gray-900">Género do agente <sup class="text-danger small">&#10033;</sup></label>
                    <select class="custom-select" name="genero" id="genero" value="{{old('genero', $agent->genero)}}" required>
                        <option selected disabled hidden>Escolher género...</option>
                        <option {{old('genero',$agent->genero)=='M'?"selected":""}} value="M">Masculino</option>
                        <option {{old('genero',$agent->genero)=='F'?"selected":""}} value="F">Feminino</option>
                    </select>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="dataNasc" class="text-gray-900">Data de nascimento <sup class="text-danger small">&#10033;</sup></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                        <input type="date" class="form-control" name="dataNasc" id="dataNasc" value="{{old('dataNasc', $agent->dataNasc)}}" required>
                        <div class="invalid-feedback">
                            Oops, parece que algo não está bem...
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="fotografia" class="text-gray-900">Fotografia</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="fotografia" id="fotografia">
                        <small class="form-text text-muted">A fotografia não deve ultrupassar 2MB.</small>
                        <label class="custom-file-label" for="screenshot" data-browse="Escolher">Escolher fotografia...</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="observacoes" class="text-gray-900">Observacões</label>
                    <input type="text" class="form-control" name="observacoes" id="observacoes" placeholder="Inserir uma observação..." value="{{old('observacoes', $agent->observacoes)}}">
                </div>
            </div>
        </div>

        <!-- Secção para o conteúdo dos DOCUMENTOS -->
        <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
            <div class="form-row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="img_doc" class="text-gray-900">Documento de identificação</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="img_doc" id="img_doc" accept="application/pdf, image/*">
                        <small class="form-text text-muted">O documento não deve ultrupassar 2MB.</small>
                        <label class="custom-file-label" for="screenshot" data-browse="Escolher">Escolher documento...</label>
                    </div>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="num_doc" class="text-gray-900">Número de identificação pessoal <sup class="text-danger small">&#10033;</sup> </label>
                    <input type="text" class="form-control" name="num_doc" id="num_doc" placeholder="Inserir um número..." value="{{old('num_doc', $agent->num_doc)}}" required>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="NIF" class="text-gray-900">Número NIF <sup class="text-danger small">&#10033;</sup> </label>
                    <input type="text" class="form-control" name="NIF" id="NIF" placeholder="Inserir um número NIF..." value="{{old('NIF', $agent->NIF)}}" required>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
            </div>
        </div>

        <!-- Secção para o conteúdo dos CONTACTOS -->
        <div class="tab-pane fade " id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="email" class="text-gray-900">Endereço eletrónico <sup class="text-danger small">&#10033;</sup> </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Inserir um endereço eletrónico..." value="{{old('email', $agent->email)}}" required>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pais" class="text-gray-900">País do agente <sup class="text-danger small">&#10033;</sup></label>
                    <input type="hidden" id="hidden_pais" value="{{old('pais', $agent->pais)}}">
                    <select class="custom-select" name="pais" id="pais" value="{{old('pais', $agent->pais)}}" required>
                        @if ($agent->pais != null)
                            <option selected value="{{$agent->pais}}">{{$agent->pais}}</option>
                        @else
                            <option selected disabled hidden>Escolha um país...</option>
                        @endif
                        @include('agents.partials.countries');
                    </select>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="telefone1" class="text-gray-900">Telefone principal <sup class="text-danger small">&#10033;</sup> </label>
                    <input type="text" class="form-control" name="telefone1" id="telefone1" placeholder="Inserir um número de telefone..." value="{{old('telefone1', $agent->telefone1)}}" required>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefone2" class="text-gray-900">Telefone secundário</label>
                    <input type="text" class="form-control" name="telefone2" id="telefone2" placeholder="Inserir um número de telefone..." value="{{old('telefone2', $agent->telefone2)}}">
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="morada" class="text-gray-900">Morada <sup class="text-danger small">&#10033;</sup> </label>
                    <input type="text" class="form-control" name="morada" id="morada" placeholder="Inserir uma morada..." value="{{old('morada', $agent->morada)}}" required>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
            </div>
        </div>

        <!-- Secção para o conteúdo do FINANCEIRO -->
        <div class="tab-pane fade " id="financas" role="tabpanel" aria-labelledby="financas-tab">
            <div class="form-row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="IBAN" class="text-gray-900">IBAN</label>
                    <input type="text" class="form-control" name="IBAN" id="IBAN" placeholder="Inserir um IBAN..." value="{{old('IBAN', $agent->IBAN)}}">
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
