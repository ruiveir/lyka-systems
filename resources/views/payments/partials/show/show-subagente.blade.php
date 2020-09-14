<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Visualização de um pagamento</h1>
    <div>
        <a href="{{route('payments.editsubagente', [$subagente, $fase, $responsabilidade, $pagoResponsabilidade])}}" class="btn btn-success btn-icon-split btn-sm" title="Editar">
            <span class="icon text-white-50">
                <i class="fas fa-pencil-alt"></i>
            </span>
            <span class="text">Editar pagamento</span>
        </a>
        <a href="#" data-toggle="modal" data-target="#infoModal" class="btn btn-secondary btn-icon-split btn-sm" title="Informações">
            <span class="icon text-white-50">
                <i class="fas fa-info-circle"></i>
            </span>
            <span class="text">Informações</span>
        </a>
    </div>
</div>
<!-- Approach -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Visualização do pagamento sobre a fase {{$fase->descricao}} do subagente {{$subagente->nome.' '.$subagente->apelido}}.</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="text-gray-800"><b>Beneficiário:</b> @if($pagoResponsabilidade->beneficiario != null) {{$pagoResponsabilidade->beneficiario}} @else N/A @endif </p>
            </div>
            <div class="col-md-6">
                <p class="text-gray-800"><b>Descrição do pagamento:</b> @if($pagoResponsabilidade->descricao != null) {{$pagoResponsabilidade->descricao}} @else N/A @endif </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p class="text-gray-800"><b>Valor pago:</b> @if($pagoResponsabilidade->valorPago != null) {{number_format((float)$pagoResponsabilidade->valorPago, 2, ',', '').'€'}} @else N/A @endif</p>
            </div>
            <div class="col-md-6">
                <p class="text-gray-800"><b>Data da operação:</b> @if($pagoResponsabilidade->dataPagamento != null) {{date('d/m/Y', strtotime($pagoResponsabilidade->dataPagamento))}} @else N/A @endif</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p class="text-gray-800"><b>Conta bancária:</b> @if($pagoResponsabilidade->idConta != null) {{$pagoResponsabilidade->conta->descricao}} @else N/A @endif</p>
            </div>
            <div class="col-md-6">
                <p class="text-gray-800"><b>Comprovativo de pagamento:</b> @if($pagoResponsabilidade->comprovativoPagamento != null) <a href="{{route("payments.downloadComprovativo", $pagoResponsabilidade)}}">{{$pagoResponsabilidade->comprovativoPagamento}}</a> @else N/A @endif</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p class="text-gray-800"><b>Nota de pagamento:</b> <a target="_blank" href="{{route('payments.download', $pagoResponsabilidade)}}">nota_pagamento.pdf</a> </p>
            </div>
            <div class="col-md-6">
                <p class="text-gray-800"><b>Observações:</b> @if($pagoResponsabilidade->observacoes != null) {{$pagoResponsabilidade->observacoes}} @else N/A @endif</p>
            </div>
        </div>
        <hr>
        <p class="text-gray-800"><b>Data de registo:</b> {{date('d/m/Y', strtotime($pagoResponsabilidade->created_at))}}</p>
        <p class="text-gray-800"><b>Última atualização:</b> @if($pagoResponsabilidade->updated_at != null) {{date('d/m/Y', strtotime($pagoResponsabilidade->updated_at))}} @else N/A @endif</p>
    </div>
</div>
