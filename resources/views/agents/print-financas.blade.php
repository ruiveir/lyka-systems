<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ficha financeira - Lyka Systems</title>
	<link href="{{public_path('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
	<style media="screen">
		body {
			padding: 3px 33px;
			font-family: 'Lato', sans-serif;
			font-size: 10pt;
		}

		img {
			width: 130px;
		}

		#text-beneficiario {
			position: relative;
			top: -10px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			font-size: 8pt;
		}

		th, td {
		  padding: 5px 10px;
		  text-align: left;
		}

		table, th, td {
			border: 1px solid black;
		}
	</style>
	<br>
	<div class="row">
		<div class="col-md-6">
			<img src="{{public_path('/media/logo.png')}}" alt="Logótipo - Estudar Portugal">
		</div>
		<div class="col-md-6">
			<div class="text-right" id="text-beneficiario">
				<p class="mb-0 font-weight-bold text-grey-900">Ficha Financeira do Agente: <span class="font-weight-normal">{{$agente->nome.' '.$agente->apelido}}</span></p>
				<p class="mb-0 font-weight-bold">Produto Associado: <span class="font-weight-normal">{{$produto->descricao}}</span></p>
				<p class="font-weight-bold">Cliente Associado: <span class="font-weight-normal">{{$produto->cliente->nome.' '.$produto->cliente->apelido}}</span></p>
			</div>
		</div>
	</div>
	@if (isset($fases) && count($fases))
		<p class="font-weight-bold">Listagem das Cobranças</p>
		<table>
			<thead>
				<tr>
					<th>Fase</th>
					<th>Valor</th>
					<th>Data de Vencimento</th>
					<th>Estado</th>
					<th>Observações</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($fases as $fase)
					<tr>
						<td>{{$fase->descricao}}</td>
						<td>{{number_format((float) $fase->valorFase, 2, ',', '')}}&euro;</td>
						<td>{{date('d/m/Y', strtotime($fase->dataVencimento))}}</td>
						<td>{{$fase->estado}}</td>
						<td>N/A</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif

	@if (isset($responsabilidades) && count($responsabilidades))
		<p class="font-weight-bold @if (isset($fases) && count($fases)) mt-5 @endif">Listagem dos Pagamentos</p>
		<table>
			<thead>
				<tr>
					<th>Beneficiário</th>
					<th>Fase</th>
					<th>Valor</th>
					<th>Data de Vencimento</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($responsabilidades as $responsabilidade)
					<tr>
						<td>{{$responsabilidade->agente->nome.' '.$responsabilidade->agente->apelido}}</td>
						<td>{{$responsabilidade->fase->descricao}}</td>
						<td>{{number_format((float) $responsabilidade->valorAgente, 2, ',', '')}}&euro;</td>
						<td>{{date('d/m/Y', strtotime($responsabilidade->dataVencimentoAgente))}}</td>
						<td>
						@if (!$responsabilidade->verificacaoPagoAgente && $responsabilidade->dataVencimentoAgente < $currentdate)
							Vencido
						@elseif (!$responsabilidade->verificacaoPagoAgente && $responsabilidade->dataVencimentoAgente > $currentdate)
							Pendente
						@elseif ($responsabilidade->verificacaoPagoAgente)
							Pago
						@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
</body>
</html>
