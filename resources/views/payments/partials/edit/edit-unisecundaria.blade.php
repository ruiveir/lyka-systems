<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Formulário de edição de um pagamento sobre a universidade {{$fase->produto->universidade2->nome}}</h6>
</div>
<div class="card-body">
    <form method="POST" class="form-group needs-validation" id="editar-pagamento-form" novalidate>
        @csrf
        <div class="container-fluid">
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="valorPagoUni2" class="text-gray-900">Valor pago a universidade <sup class="text-danger small">&#10033;</sup> </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="valorPagoUni2" id="valorPagoUni2" aria-describedby="validatedInputGroupPrepend" value="{{old('valorPagoUni2', number_format((float)$pagoResponsabilidade->valorPago, 2, ',', ''))}}" required>
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
                    <label for="comprovativoPagamentoUni2" class="text-gray-900">Comprovativo de pagamento</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="comprovativoPagamentoUni2" id="comprovativoPagamentoUni2">
                        <small class="form-text text-muted">O comprovativo não deve ultrupassar 2MB.</small>
                        @if($pagoResponsabilidade->comprovativoPagamento)
                            <label class="custom-file-label" for="comprovativoPagamento" data-browse="Escolher">{{old("comprovativoPagamento", $pagoResponsabilidade->comprovativoPagamento)}}</label>
                        @else
                            <label class="custom-file-label" for="comprovativoPagamento" data-browse="Escolher">Escolher um comprovativo...</label>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="dataUni2" class="text-gray-900">Data de pagamento <sup class="text-danger small">&#10033;</sup></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                    <input type="date" class="form-control" name="dataUni2" id="dataUni2" value="{{old('dataUni2', $pagoResponsabilidade->dataPagamento)}}" required>
                </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="contaUni2" class="text-gray-900">Conta bancária <sup class="text-danger small">&#10033;</sup></label>
                    <select class="custom-select" name="contaUni2" id="contaUni2" value="{{old('contaUni2', $pagoResponsabilidade->idConta)}}" required>
                        @foreach ($contas as $conta)
                        <option value="{{$conta->idConta}}">{{$conta->descricao}}</option>
                        @endforeach
                        <option hidden value="{{$pagoResponsabilidade->idConta}}" selected>{{$pagoResponsabilidade->conta->descricao}}</option>
                    </select>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="descricaoUni2" class="text-gray-900">Descrição do pagamento <sup class="text-danger small">&#10033;</sup></label>
                    <input type="text" class="form-control" name="descricaoUni2" id="descricaoUni2" value="Pagamento a universidade {{$fase->produto->universidade2->nome}}." required>
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
                <button type="submit" name="button" class="btn btn-primary text-white font-weight-bold" id="submitbtn">Editar pagamento</button>
            </div>
        </div>
    </form>
</div>
