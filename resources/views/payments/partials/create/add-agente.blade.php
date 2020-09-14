<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Formulário de registo de um pagamento sobre o agente {{$fase->produto->agente->nome.' '.$fase->produto->agente->apelido}}.</h6>
</div>
<div class="card-body">
    <form method="POST" class="form-group needs-validation" id="registar-pagamento-form" novalidate>
        @csrf
        <div class="container-fluid">
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="valorPagoAgente" class="text-gray-900">Valor pago ao agente <sup class="text-danger small">&#10033;</sup> </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="valorPagoAgente" id="valorPagoAgente" aria-describedby="validatedInputGroupPrepend" value="{{old('valorPagoAgente', number_format((float)$responsabilidade->valorAgente, 2, ',', ''))}}" required>
                        <div class="input-group-append">
                            <span class="input-group-text">€</span>
                        </div>
                        <div class="invalid-feedback">
                            Oops, parece que algo não está bem...
                        </div>
                    </div>
                    <small class="form-text text-muted">Utilizar vírgula para separar decimais.</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="comprovativoPagamentoAgente" class="text-gray-900">Comprovativo de pagamento</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="comprovativoPagamentoAgente" id="comprovativoPagamentoAgente">
                        <small class="form-text text-muted">O comprovativo não deve ultrupassar 2MB.</small>
                        <label class="custom-file-label" for="screenshot" data-browse="Escolher">Escolher ficheiro...</label>
                    </div>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="dataAgente" class="text-gray-900">Data de pagamento <sup class="text-danger small">&#10033;</sup></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                        <input type="date" class="form-control" name="dataAgente" id="dataAgente" value="{{old('dataAgente', $pagoResponsabilidade->dataPagamento)}}" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="contaAgente" class="text-gray-900">Conta bancária <sup class="text-danger small">&#10033;</sup></label>
                    <select class="custom-select" name="contaAgente" id="contaAgente" value="{{old('contaAgente', $pagoResponsabilidade->idConta)}}" required>
                        @foreach ($contas as $conta)
                        <option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
                        @endforeach
                        <option selected disabled hidden>Escolher conta bancária</option>
                    </select>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="descricaoAgente" class="text-gray-900">Descrição do pagamento <sup class="text-danger small">&#10033;</sup></label>
                    <input type="text" class="form-control" name="descricaoAgente" id="descricaoAgente" value="Pagamento ao agente {{$fase->produto->agente->nome.' '.$fase->produto->agente->apelido}}." required>
                    <small class="form-text text-muted">Esta descrição irá ser utilizada na nota de pagamento.</small>
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="observacoes" class="text-gray-900">Observações</label>
                    <input type="text" class="form-control" name="observacoes" id="observacoes" placeholder="Inserir uma observação..." value="{{old('observacoes', $pagoResponsabilidade->observacoes)}}">
                    <div class="invalid-feedback">
                        Oops, parece que algo não está bem...
                    </div>
                </div>
            </div>
            <div class="text-right mt-3" id="groupBtn">
                <span class="mr-4 font-weight-bold" onclick="window.history.back();" id="cancelBtn" style="cursor:pointer;">Cancelar</span>
                <button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Registar pagamento</button>
            </div>
        </div>
    </form>
</div>
