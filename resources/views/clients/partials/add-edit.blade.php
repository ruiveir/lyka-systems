<div class="alert alert-danger my-2" id="warning_msg" style="display: none"><i class="fas fa-exclamation-triangle mr-2"></i>Existem dados obrigatórios por preencher. Verifique os campos assinalados.</div>

@if (Auth::user()->tipo == "admin")
    <div class="mb-2" >

        <div class="row">
                <div id="div_agente" class="col m-3 py-4 border shadow-sm">
                    <div class="mx-2 my-auto">
                        <i class="fas fa-user-tie active mr-3 ml-3"></i><label for="idAgente" class="font-weight-bold">Agente responsável:</label>
                        <div class="mr-3">
                            <select class="form-control select_style ml-2" id="idAgente" name="idAgente" style="min-width: 200px" required>
                                <option selected value="0">(selecione um agente)</option>
                                @if($agents)
                                    @foreach($agents as $agent)
                                        <option value="{{$agent->idAgente}}"  {{old('idAgente', $client->idAgente ) == $agent->idAgente ? "selected" : "" }}   >{{$agent->nome}} {{$agent->apelido}} ({{$agent->pais}})</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                </div>

                <div class="col m-3 py-4 border shadow-sm" style="min-width: 412px">
                    <div class="mx-2 my-auto">
                        <div class="row">
                            <div class="col">
                                {{-- Estado do cliente --}}
                                <i class="fas fa-traffic-light active mr-3 ml-3"></i><label for="estado" class="font-weight-bold">Estado do cliente:</label>
                                    <select class="form-control select_style ml-2" id="estado" name="estado" style="min-width: 200px" required>
                                        <option {{old('idAgente', $client->estado ) == "Inativo" ? "selected" : "" }} value="Inativo">Inativo</option>
                                        <option {{old('idAgente', $client->estado ) == "Ativo" ? "selected" : "" }} value="Ativo">Ativo</option>
                                        <option {{old('idAgente', $client->estado ) == "Proponente" ? "selected" : "" }} value="Proponente">Proponente</option>
                                    </select>
                            </div>

                            <div class="col text-center" style="max-width: 100px">

                                {{-- Permitir/negar edição --}}
                                <div id="btn_editavel" class="bg-lighth h-100 border shadow-sm" style="cursor:pointer; border-radius:10px">
                                    <div class="p-3">
                                        <input name="editavel" id="editavel" type="hidden" value="{{$client->editavel}} ">
                                        <i id="editavel_sim" class="fas fa-lock-open text-success my-auto" style="font-size: 25px; display:none" title="Os agentes podem modificar as informações"></i>
                                        <i id="editavel_nao" class="fas fa-lock text-danger" style="font-size: 25px; display:none" title="Os agentes NÃO podem modificar as informações"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>

    </div>
@else

    {{-- campos auxiliares --}}
    <input type="hidden" id="idAgente" name="idAgente" value="{{old('idAgente', $client->idAgente )}}">
    <input type="hidden" id="estado" value="{{old('estado', $client->estado )}}">

@endif

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
            <div class="row">
                <div class="col">

                    <div class="row">
                        <div class="col" style="min-width:250px">
                            {{-- INPUT nome --}}
                            <label for="nome">Nome:</label><br>
                            <input type="text" class="form-control" name="nome" id="nome"
                                value="{{old('nome',$client->nome)}}" placeholder="Insira o nome do aluno"
                                maxlength="20" required>
                                <br>
                        </div>
                        <div class="col" style="min-width:250px">
                            {{-- INPUT apelido --}}
                            <label for="apelido">Apelido:</label><br>
                            <input type="text" class="form-control" name="apelido" id="apelido"
                                value="{{old('apelido',$client->apelido)}}" placeholder="Insira o apelido do aluno"
                                maxlength="20" required>
                                <br>
                        </div>
                    </div>



                    <div class="row mb-4">

                        <div class="col" style="min-width:250px">
                            {{-- INPUT GENERO --}}
                            <label for="genero">Género:</label><br>
                            <select id="genero" name="genero" style="width:100%" class="form-control select_style" required>
                                <option value="" selected hidden>Selecione o género</option>
                                <option {{old('genero',$client->genero)=='F'?"selected":""}} value="F">Feminino</option>
                                <option {{old('genero',$client->genero)=='M'?"selected":""}} value="M">Masculino
                                </option>
                            </select>
                            <br>
                        </div>

                        <div class="col" style="min-width:250px">

                            {{-- INPUT paisNaturalidade --}}
                            <label for="paisNaturalidade">Naturalidade:</label><br>
                            <input type="hidden" id="hidden_paisNaturalidade"
                                value="{{old('paisNaturalidade',$client->paisNaturalidade)}}">
                            <select id="paisNaturalidade" name="paisNaturalidade" style="width:100%" class="form-control select_style" required>
                                @include('clients.partials.countries');
                            </select>
                          </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-6" style="min-width:250px">
                        {{-- INPUT dataNasc --}}
                        <label for="dataNasc">Data de nascimento:</label><br>
                        <input type="date" class="form-control" name="dataNasc" id="dataNasc"
                            value="{{old('dataNasc',$client->dataNasc)}}" style="width:100%" class="form-control select_style" >
                        </div>
                    </div>

                    <br>

                </div>

                <div class="col col-4 text-center align-middle" style="min-width: 300px" >
                    {{-- INPUT fotografia --}}
                    <div>
                        <label for="fotografia">Fotografia:</label>
                        <input type='file' id="fotografia" name="fotografia" style="display:none" accept="image/*" />

                    </div>

                    <div class="text-center align-self-center align-middle mx-auto" style="width:300px; max-height:300px; overflow:hidden;">
                        <!-- Verifica se a imagem já existe-->
                        @if ($client->fotografia!=null)
                        <img src="{{Storage::disk('public')->url('client-documents/'.$client->idCliente.'/').$client->fotografia}}"
                            id="preview" class="m-2 p-1 border rounded bg-white shadow-sm"
                            style="width:80%; height:auto; cursor:pointer; min-width:118px;" alt="Imagem de apresentação"
                            title="Clique para mudar a imagem de apresentação" />
                        @else

                        <img src="{{Storage::disk('public')->url('default-photos/m.jpg')}}" id="preview"
                            class="p-1 border rounded bg-white shadow-sm " style="width:80%; cursor:pointer; min-width:118px; max-height:300px;"
                            alt="Imagem de apresentação" title="Clique para mudar a imagem de apresentação" />
                        @endif
                    </div>
                    <div class="mt-2"><small class="text-muted">(clique para mudar)</small></div>
                </div>
            </div>


            {{-- Campo de referência do cliente para o admin --}}
            @if (Auth::user()->tipo == "admin")
            <br>
                <div class="row">
                    <div class="col-md-12">
                        {{-- INPUT obsPessoais --}}
                        <label for="obsPessoais">Referência do cliente:</label><br>
                        <textarea name="refCliente" id="refCliente" rows="2" style="width:100%">{{old('refCliente',$client->refCliente)}}</textarea>
                    </div>
                </div>
            @endif


            {{-- Campo de Observações para o admin --}}
            @if (Auth::user()->tipo == "admin")
            <br>
                <div class="row">
                    <div class="col-md-12">
                        {{-- INPUT obsPessoais --}}
                        <label for="obsPessoais">Observações pessoais:</label><br>
                        <textarea name="obsPessoais" id="obsPessoais" rows="5" style="width:100%">{{old('obsPessoais',$client->obsPessoais)}}</textarea>
                    </div>
                </div>
            @endif

            {{-- Campo de Observações para o agente / admin --}}
            <div class="row">
                <div class="col-md-12">
                    <br>
                    {{-- INPUT PARA O AGENTE obsAgente --}}
                    <label for="obsPessoais">Observações @if (Auth::user()->tipo == "admin")(do agente)@endif:</label><br>
                    <textarea name="obsAgente" id="obsAgente" rows="5" style="width:100%">{{old('obsAgente',$client->obsAgente)}}</textarea>
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
</div>
