            <div class="row">
                <div class="col-md-4">
                    <label for="contaSubAgente">Associar conta bancária</label>
                    <br>
                    <select name="contaSubAgente" id="contaSubAgente">
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
                    <label for="descricaoSubAgente">Descrição do pagamento</label>
                    <br>
                    <input type="text" name="descricaoSubAgente" id="descricaoSubAgente" required="required" placeholder="Adicionar uma descrição" maxlength="150">
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
</div> --}}


<form class="form-group needs-validation" id="registar-pagamento-form" novalidate action="{{route('report.send')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" id="idResp" name="idResp" value="{{$responsabilidade->idResponsabilidade}}" hidden="true">
    <div class="container-fluid">
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="valorPagoSubAgente" class="text-gray-900">Valor pago ao subagente <sup class="text-danger small">&#10033;</sup> </label>
                <input type="text" class="form-control" name="valorPagoSubAgente" id="valorPagoSubAgente" value="{{number_format((float)$responsabilidade->valorSubAgente, 2, ',', '').'€'}}" required>
                <div class="invalid-feedback">
                    Oops, parece que algo não está bem...
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="comprovativoPagamentoSubAgente" class="text-gray-900">Comprovativo de pagamento</label>
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" name="comprovativoPagamentoSubAgente" id="comprovativoPagamentoSubAgente">
                    <small class="form-text text-muted">O comprovativo não deve ultrupassar 2MB.</small>
                    <label class="custom-file-label" for="screenshot" data-browse="Escolher">Escolher ficheiro...</label>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="dataSubAgente" class="text-gray-900">Data de pagamento</label>
                <input type="date" class="form-control" name="dataSubAgente" id="dataSubAgente">
            </div>
            <div class="col-md-6 mb-3">
                <label for="screenshot" class="text-gray-900">Conta bancária</label>
                <select class="custom-select" name="contaSubAgente" id="contaSubAgente">
                    @foreach ($contas as $conta)
                    <option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
                    @endforeach
                    <option selected disabled hidden>Escolher conta bancária</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col mb-3">
                <label for="relatorio" class="text-gray-900">Descrição do problema <sup class="text-danger small">&#10033;</sup></label>
                <textarea class="form-control" name="relatorio" id="relatorio" rows="5" required placeholder="Qual é o problema?"></textarea>
                <div class="invalid-feedback">
                    Oops, parece que algo não está bem...
                </div>
            </div>
        </div>
        <div class="text-right mt-3" id="groupBtn">
            <span class="mr-4 font-weight-bold" onclick="window.history.back();" id="cancelBtn" style="cursor:pointer;">Cancelar</span>
            <button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Enviar relatório</button>
        </div>
    </div>
</form>
