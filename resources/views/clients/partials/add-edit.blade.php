{{-- <div class="alert alert-danger my-2" id="warning_msg" style="display: none"><i class="fas fa-exclamation-triangle mr-2"></i>Existem dados obrigatórios por preencher. Verifique os campos assinalados.</div> --}}

<div class="container-fluid">
    @if (Auth::user()->tipo == "admin")
    <div class="form-row mb-3">
        <div class="col-md-4 mb-3">
            <label for="idAgente" class="text-gray-900">Agente responsável <sup class="text-danger small">&#10033;</sup> </label>
            <select class="custom-select" id="idAgente" name="idAgente" required>
                <option selected disabled hidden>Escolher agente...</option>
                @if($agents)
                    @foreach($agents as $agent)
                        <option value="{{$agent->idAgente}}" {{old('idAgente', $client->idAgente ) == $agent->idAgente ? "selected" : "" }}   >{{$agent->nome.' '.$agent->apelido}} ({{$agent->pais}})</option>
                    @endforeach
                @endif
            </select>
            <div class="invalid-feedback">
                Oops, parece que algo não está bem...
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="descricao" class="text-gray-900">Subagente responsável <sup class="text-danger small">&#10033;</sup> </label>
            <select class="custom-select" id="idAgente" name="idAgente" required>
                <option selected disabled hidden>Escolher subagente...</option>
                {{-- @foreach($SubAgentes as $subagente)
                    <option {{old('idSubAgente',$produto->idSubAgente)}} value="{{$subagente->idAgente}}">{{$subagente->nome.' '.$subagente->apelido.' ('.$subagente->email.')'}}</option>
                @endforeach --}}
            </select>
            <div class="invalid-feedback">
                Oops, parece que algo não está bem...
            </div>
        </div>
        <div class="col-md-4 mb-3">
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
    </div>
    @else
        <input type="hidden" id="idAgente" name="idAgente" value="{{old('idAgente', $client->idAgente)}}">
        <input type="hidden" id="estado" value="{{old('estado', $client->estado)}}">
    @endif
</div>

<div class="row nav nav-fill w-100 text-center mx-auto p-3">
    <a class="nav-item nav-link active border p-3 m-1 bg-white rounded shadow-sm" id="pessoal-tab"
        data-toggle="tab" href="#pessoal" role="tab" aria-controls="pessoal" aria-selected="true">
        <div class="col"><i class="fas fa-user mr-2"></i>Dados pessoais</div>
    </a>

    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm" id="documentation-tab"
        data-toggle="tab" href="#documentation" role="tab" aria-controls="documentation" aria-selected="false">
        <div class="col"><i class="far fa-id-card mr-2"></i>Documentos</div>
    </a>

    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm" id="academicos-tab"
        data-toggle="tab" href="#school" role="tab" aria-controls="school" aria-selected="false">
        <div class="col" style="min-width: 197px"><i class="fas fa-graduation-cap mr-2"></i>Dados académicos
        </div>
    </a>

    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm" id="contacts-tab" data-toggle="tab"
        href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">
        <div class="col"><i class="fas fa-comments mr-2"></i>Contactos</div>
    </a>

    <a class="nav-item nav-link border p-3 m-1 bg-white rounded shadow-sm border" id="financas-tab" data-toggle="tab"
        href="#financas" role="tab" aria-controls="financas" aria-selected="false">
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
                        <small class="form-text text-muted">A fotografia não deve ultrupassar os 5MB.</small>
                        <label class="custom-file-label" for="fotografia" data-browse="Escolher">Escolher fotografia...</label>
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

            {{-- Campo de referência do cliente para o admin --}}
            @if (Auth::user()->tipo == "admin")
                <div class="form-row mb-3">
                    <div class="col mb-3">
                        <label for="refCliente" class="text-gray-900">Observações do administrador</label>
                        <textarea class="form-control" name="refCliente" id="refCliente" rows="2" placeholder="Inserir uma observação...">{{old('refCliente',$client->refCliente)}}</textarea>
                        <small class="form-text text-muted">Atenção! Visível apenas para o administrador.</small>
                    </div>
                </div>
            @endif


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
            <div class="row">
                <div class="col">

                    <div class="row">
                        <div class="col" style="min-width:300px">
                            <label for="num_docOficial">Número de identificação pessoal:</label><br>
                            <input type="text" class="form-control" name="num_docOficial" id="num_docOficial"
                                value="{{old('num_docOficial',$client->num_docOficial)}}" placeholder="Número de identificação pessoal"  maxlength="20">
                        </div>
                        <div class="col">
                            <label for="validade_docOficial">Data de validade:</label><br>
                            <input type="month" class="form-control" name="validade_docOficial"
                                id="validade_docOficial"
                                value="{{$client->validade_docOficial}}" >
                        </div>
                    </div>

                    <br>

                    <label for="NIF">Número de identificação fiscal:</label><br>
                    <input type="text" class="form-control" name="NIF" id="NIF" value="{{old('NIF',$client->NIF)}}"
                        maxlength="20" placeholder="Número de identificação fiscal"><br>

                </div>




                {{-- INPUT IMG DOCUMENTO identificação --}}
                <div class="col text-center" style="max-width:380px;min-width:298px;">
                    <div>
                        <label for="img_docOficial">Documento de identificação:</label>
                        <input type='file' id="img_docOficial" name="img_docOficial" style="display:none"
                            accept="application/pdf, image/*" />
                    </div>

                    <div class="card mx-auto p-4 rounded shadow-sm text-center "
                        style="width:80%;min-width:118px;min-height:120px">

                        @if ( isset ($docOfficial) )
                        <a href="#" title="Clique para modificar o documento de identificação" id="doc_id_preview"
                            class="">
                                @if ($docOfficial->imagem == null)
                                    <div class="text-danger">
                                        <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                                        <div id="name_doc_id_file">
                                        <div>Sem imagem do documento</div>
                                    </div>
                                @else
                                    <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                                    <div id="name_doc_id_file">
                                    <div>{{$docOfficial->imagem}}</div>
                                @endif

                            </div>
                        </a>
                        @else
                        <a style="display:none;cursor:pointer"
                            title="Clique para adicionar o documento de identificação" id="doc_id_preview"
                            class="">
                            <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                            <div id="name_doc_id_file" class="text-muted">

                            </div>
                        </a>
                        <i id="doc_id_preview_file" class="fas fa-plus-circle mt-2"
                            style="font-size:60px;cursor:pointer"
                            title="Clique para adicionar o documento de identificação"></i>
                        @endif

                    </div>
                    <small class="text-muted">(clique para mudar)</small>

                </div>



            </div>


            <hr class="my-4">


            {{-- Passaporte --}}
            <div class="row">
                <div class="col">

                    <div class="row">
                        <div class="col" style="min-width: 285px!important">
                            {{-- INUPUT numPassaporte --}}
                            <label for="numPassaporte">Número do passaporte:</label><br>
                            <input type="text" class="form-control" name="numPassaporte" id="numPassaporte"
                                value="{{old('numPassaporte',$client->numPassaporte)}}" maxlength="20" placeholder="Número do passaporte">
                        </div>
                        <div class="col" style="min-width: 285px!important">
                            {{-- INUPUT dataValidPP --}}
                            <label for="dataValidPP">Data de validade do passaporte:</label><br>
                            <input type="month" class="form-control" name="dataValidPP" id="dataValidPP"
                                value="{{$passaporteData->dataValidPP ?? ''}}" >
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col" style="min-width: 285px!important">
                            {{-- INUPUT passaportPaisEmi --}}
                            <label for="passaportPaisEmi">País emissor do passaporte:</label><br>
                            <input type="hidden" id="hidden_passaportPaisEmi"
                                value="{{$passaporteData->passaportPaisEmi ?? ''}}">
                            <select id="passaportPaisEmi" name="passaportPaisEmi" style="width:100%" class="form-control select_style" >
                                @include('clients.partials.countries');
                            </select>
                        </div>
                        <div class="col" style="min-width: 285px!important">
                            {{-- INUPUT localEmissaoPP --}}
                            <label for="localEmissaoPP">Local de emissão do passaporte:</label><br>
                            <input type="text" class="form-control" name="localEmissaoPP" id="localEmissaoPP"
                                value="{{$passaporteData->localEmissaoPP ?? ''}}" maxlength="30"  placeholder="Insira o local de emissão">
                        </div>
                    </div>

                </div>


                {{-- INPUT IMG PASSAPORTE --}}
                <div class="col text-center" style="max-width:380px;min-width:298px;">
                    <div>
                        <label for="img_Passaporte">Passaporte:</label>
                        <input type='file' id="img_Passaporte" name="img_Passaporte" style="display:none"
                            accept="application/pdf, image/*" />
                    </div>

                    <div class="card mx-auto p-4 rounded shadow-sm text-center "
                        style="width:80%;min-width:118px;min-height:120px">

                        @if ( isset ($passaporte) )
                            <a href="#" title="Clique para modificar o documento do passaporte" id="passporte_preview"
                                class="">
                                    @if ($passaporte->imagem == null)
                                        <div class="text-danger">
                                            <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                                            <div id="name_passaporte_file">
                                            <div>Sem imagem do documento</div>
                                        </div>
                                    @else
                                        <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                                        <div id="name_passaporte_file">
                                        <div>{{$passaporte->imagem}}</div>
                                    @endif

                                </div>
                            </a>
                        @else
                            <a style="display:none;cursor:pointer"
                                title="Clique para adicionar o documento do passaporte" id="passporte_preview"
                                class="">
                                <i class="far fa-id-card mt-2" style="font-size:50px"></i>
                                <div id="name_passaporte_file" class="text-muted">

                                </div>
                            </a>
                            <i id="passport_preview_file" class="fas fa-plus-circle mt-2"
                                style="font-size:60px;cursor:pointer"
                                title="Clique para adicionar o documento do passaporte"></i>
                        @endif

                    </div>
                    <small class="text-muted">(clique para mudar)</small>

                </div>

            </div>

        </div>



        {{-- Conteudo: Dados académicos --}}
        <div class="tab-pane fade" id="school" role="tabpanel" aria-labelledby="school-tab">
            <div class="row">
                <div class="col mr-3" style="min-width: 330px !important">
                    {{-- INPUT nivEstudoAtual --}}
                    <label for="nivEstudoAtual">Nível de estudos(atual):</label><br>
                    <select name="nivEstudoAtual" id="nivEstudoAtual" style="width:100%" class="form-control select_style" >
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)==null?"selected":""}} value="0" selected hidden>Selecione nível</option>
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='Secundário Incompleto'?"selected":""}} value="Secundário Incompleto">Secundário Incompleto</option>
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='Secundário Completo'?"selected":""}} value="Secundário Completo">Secundário Completo</option>
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='Curso Tecnológico'?"selected":""}} value="Curso Tecnológico">Curso Tecnológico</option>
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='Estuda na Universidade'?"selected":""}} value="Estuda na Universidade">Estuda na Universidade</option>
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='Licenciado'?"selected":""}} value="Licenciado">Licenciado</option>
                        <option {{old('nivEstudoAtual',$client->nivEstudoAtual)=='Mestrado'?"selected":""}} value="Mestrado">Mestrado</option>

                    </select>

                    <br>




                    {{-- INPUT Nome da instituição de origem --}}
                    <label for="nomeInstituicaoOrigem">Nome da instituição de origem:</label><br>


                    {{-- ComboBox Editavel: Instituições --}}
                    <select id="nomeInstituicaoOrigem" name="nomeInstituicaoOrigem" class="form-control select_style" style="width:100%" maxlength="50" placeholder="Insira nome da instituição de origem">
                        @if(!empty($instituicoes) )
                            @foreach ($instituicoes as $instituicao)
                                <option {{old('nomeInstituicaoOrigem', $client->nomeInstituicaoOrigem ) == $instituicao ? "selected" : "" }} value="{{$instituicao}}" >{{$instituicao}}</option>
                            @endforeach
                        @endif
                    </select>

{{--
                    <input type="text" class="form-control" name="nomeInstituicaoOrigem" id="nomeInstituicaoOrigem"
                        value="{{old('nomeInstituicaoOrigem',$client->nomeInstituicaoOrigem)}}"
                        maxlength="50" placeholder="Insira nome da instituição de origem"> --}}

                    <br>

                    {{--cidadeInstituicaoOrigem  --}}
                    <label for="morada">Cidade da Instituição de Origem:</label><br>

                    {{-- ComboBox Editavel: Cidade da Instituição de Origem --}}
                    <select id="cidadeInstituicaoOrigem" class="form-control select_style" style="width:100%" name="cidadeInstituicaoOrigem" maxlength="50" placeholder="Insira nome da instituição de origem">
                        @if(!empty($cidadesInstituicoes) )
                            @foreach ($cidadesInstituicoes as $cidadesInstituicao)
                                <option {{old('cidadeInstituicaoOrigem', $client->cidadeInstituicaoOrigem ) == $cidadesInstituicao ? "selected" : "" }} value="{{$cidadesInstituicao}}" >{{$cidadesInstituicao}}</option>
                            @endforeach
                        @endif
                    </select>

{{--                     <input type="text" class="form-control" name="cidadeInstituicaoOrigem" id="cidadeInstituicaoOrigem"
                        value="{{old('cidadeInstituicaoOrigem',$client->cidadeInstituicaoOrigem)}}"
                        maxlength="50" placeholder="Insira o nome da cidade da Instituição"> --}}
                    <br>
                </div>

                <div class="col" style="min-width:300px">
                   {{-- INPUT obsAcademicas --}}
                   <label for="obsAcademicas">Observações académicas:</label><br>
                   <textarea name="obsAcademicas" id="obsAcademicas" rows="5"
                       style="width: 100%; min-height:230px">{{old('obsAcademicas',$client->obsAcademicas)}}</textarea>
                </div>


            </div>
        </div>





        {{-- Conteudo: Contactos --}}
        <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            {{-- Contactos PESSOAIS --}}
            <div class="row">
                <div class="col">
                    <label for="telefone1">Telefone pessoal(1):</label><br>
                    <input type="text" class="form-control" name="telefone1" id="telefone1"
                        value="{{old('telefone1',$client->telefone1)}}" maxlength="20"  maxlength="20" placeholder="Insira o número de telefone" ><br>
                </div>
                <div class="col">
                    <label for="telefone2">Telefone pessoal(2):</label><br>
                    <input type="text" class="form-control" name="telefone2" id="telefone2"
                        value="{{old('telefone2',$client->telefone2)}}" maxlength="20" placeholder="Insira o número de telefone"><br>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="email">E-mail pessoal:</label><br>
                    <input type="email" class="form-control" name="email" id="email"
                        value="{{old('email',$client->email)}}" maxlength="250" placeholder="Insira o endereço de e-mail"><br>
                </div>
            </div>



            <div class="row ">
                <div class="col">
                    {{-- Morada de residência em Portugal --}}
                    <label for="moradaResidencia">Morada de residência em Portugal:</label><br>
                    <input type="text" class="form-control" name="moradaResidencia" id="moradaResidencia"
                        value="{{old('moradaResidencia',$client->moradaResidencia)}}" maxlength="255" placeholder="Insira a morada de residência em Portugal"><br>
                </div>


            </div>


            <hr class="my-3"><br>

            <div class="row">

                <div class="col">
                    {{-- Morada de residência no pais de origem --}}
                    <label for="morada">Morada no pais de origem:</label><br>
                    <input type="text" class="form-control" name="morada" id="morada"
                        value="{{old('morada',$client->morada)}}" maxlength="255" placeholder="Insira a morada no pais de origem" ><br>
                </div>

                <div class="col">
                    {{-- Cidade de Origem  --}}
                    <label for="cidade">Cidade de origem:</label><br>
                    <input type="text" class="form-control" name="cidade" id="cidade"
                        value="{{old('cidade',$client->cidade)}}" maxlength="50" placeholder="Insira a cidade de origem" ><br>
                </div>

            </div>

            <hr class="my-3"><br>

            {{-- Contactos dos PAIS --}}
            <div class="row">
                <div class="col">

                    <label for="nomePai">Nome do pai:</label><br>
                    <input type="text" class="form-control" name="nomePai" id="nomePai"
                        value="{{old('nomePai',$client->nomePai)}}" maxlength="250"><br>

                    <label for="telefonePai">Telefone do pai:</label><br>
                    <input type="text" class="form-control" name="telefonePai" id="telefonePai"
                        value="{{old('telefonePai',$client->telefonePai)}}" maxlength="20"><br>

                    <label for="emailPai">E-mail do pai:</label><br>
                    <input type="email" class="form-control" name="emailPai" id="emailPai"
                        value="{{old('emailPai',$client->emailPai)}}" maxlength="250"><br>
                </div>

                <div class="col">
                    <label for="nomeMae">Nome da mãe:</label><br>
                    <input type="text" class="form-control" name="nomeMae" id="nomeMae"
                        value="{{old('nomeMae',$client->nomeMae)}}" maxlength="250"><br>

                    <label for="telefoneMae">Telefone da mãe:</label><br>
                    <input type="text" class="form-control" name="telefoneMae" id="telefoneMae"
                        value="{{old('telefoneMae',$client->telefoneMae)}}" maxlength="20"><br>

                    <label for="emailMae">E-mail da mãe:</label><br>
                    <input type="email" class="form-control" name="emailMae" id="emailMae"
                        value="{{old('emailMae',$client->emailMae)}}" maxlength="250"><br>
                </div>

            </div>




        </div>



        {{-- Conteudo: Financas --}}
        <div class="tab-pane fade" id="financas" role="tabpanel" aria-labelledby="financas-tab">
            <div class="row ">
                <div class="col">


                    {{-- DADOS FINANCEIROS --}}
                    {{-- INUPUT IBAN --}}
                    <label for="IBAN" class="mr-2">IBAN: </label><br>
                    <input type="text" class="form-control" name="IBAN" id="IBAN" value="{{old('IBAN',$client->IBAN)}}"
                        maxlength="25" required placeholder="Insira o numero intenactional da conta bancária"><br>

                    {{-- INUPUT Observações Financeiras --}}
                    <label for="obsFinanceiras">Observações Financeiras:</label><br>
                    <textarea name="obsFinanceiras" id="obsFinanceiras" rows="5"
                    style="width: 100%">{{old('obsFinanceiras',$client->obsFinanceiras)}}</textarea><br><br>
                </div>


            </div>
        </div>




    </div>
</div>
