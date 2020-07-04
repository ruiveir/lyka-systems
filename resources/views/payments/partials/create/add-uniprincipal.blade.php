<div class="cards-navigation">
    <div class="title">
        <h6>Secção de pagamento: {{$universidade1->nome.' ('.$fase->descricao.')'}}</h6>
    </div>
    <br>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p style="font-weight:500;">
            Este pagamento está associado à fase <strong>{{$fase->descricao}}</strong> do produto <strong>{{$fase->produto->descricao}}</strong>, que têm como cliente
            <strong>{{$fase->produto->cliente->nome.' '.$fase->produto->cliente->apelido}}</strong> e agente <strong>{{$fase->produto->agente->nome.' '.$fase->produto->agente->apelido}}</strong>.
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="payment-card shadow-sm">
        <div id="loader-background">
            <div id="loader"></div>
        </div>
        <p style="margin-left: 0px !important; font-weight:600;">Valor a pagar:</p>
        <p style="margin-left: 0px !important;">{{number_format((float)$responsabilidade->valorUniversidade1, 2, ',', '').'€'}}</p>
        <hr>
        <form id="registar-pagamento-form" class="mt-4">
            <input type="text" id="idResp" name="idResp" value="{{$responsabilidade->idResponsabilidade}}" hidden="true">
            <div class="row">
                <div class="col-md-4">
                    <label for="valorPagoUni1">Valor pago a universidade</label>
                    <br>
                    <input type="text" name="valorPagoUni1" id="valorPagoUni1" value="{{number_format((float)$responsabilidade->valorUniversidade1, 2, ',', '').'€'}}">
                </div>
                <div class="col-md-4" oncontextmenu="return showContextMenu();">
                    <label for="comprovativoPagamentoUni1">Comp. de pagamento</label>
                    <br>
                    <input type="file" name="comprovativoPagamentoUni1" id="upfileCliente" onchange="sub(this)">
                    <div class="input-file-div text-truncate" id="addFileButtonCliente" onclick="getFileCliente()">Adicionar um ficheiro</div>
                </div>
                <div class="col-md-4">
                    <label for="dataUni1">Data de pagamento</label>
                    <br>
                    <input name="dataUni1" id="dataUni1" type="date">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label for="contaUni1">Associar conta bancária</label>
                    <br>
                    <select name="contaUni1" id="contaUni1">
                        @foreach ($contas as $conta)
                        <option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
                        @endforeach
                        <option selected disabled hidden>Escolher conta bancária</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <div class="help-button" id="tooltipValor" data-toggle="tooltip" data-placement="top" title="A descrição que inserir será colocada na nota de pagamento como descrição do mesmo.">
                        <span>
                            ?
                        </span>
                    </div>
                    <label for="descricaoUni1">Descrição do pagamento</label>
                    <br>
                    <input type="text" name="descricaoUni1" id="descricaoUni1" required="required" placeholder="Adicionar uma descrição" maxlength="150">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="observacoes">Observações</label>
                    <br>
                    <textarea name="observacoes" rows="3" placeholder="Adicionar uma observação"></textarea>
                </div>
            </div>
            <br>
    </div>
    <div class="form-group text-right">
        <br>
        <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">registar pagamento</button>
        <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
    </div>
    </form>
    <br>
</div>
