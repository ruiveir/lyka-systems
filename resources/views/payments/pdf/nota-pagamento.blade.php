<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota de pagamento - Lyka Systems</title>
    <link href="{{public_path('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <style media="screen">
        body {
            padding: 3px 33px;
            font-family: 'Lato', sans-serif;
        }

        img {
            width: 130px;
        }

        #text-beneficiario {
            font-size: 10pt;
            color: #5B5B5B;
        }

        #text-beneficiario .marginb {
            margin-bottom: -5px;
        }

        #nome {
            color: #171717 !important;
            font-size: 11pt;
            font-weight: 700;
        }

        table {
            width: 100%;
            color: #000;
        }

        table thead tr th {
            text-transform: uppercase !important;
            font-size: 10pt;
        }

        table thead th {
            padding: 10px 5px !important;
            border-bottom: 1px solid black;
        }

        table {
            border-bottom: 2px solid rgb(0, 0, 0, 0.7);
        }

        table tr td {
            padding: 8px 15px;
            font-size: 10pt;
            font-weight: 700;
            border-bottom: 1px solid rgb(0, 0, 0, 0.1);
        }

        table tr .y-border {
            border-right: 1px solid black;
        }

        table .none td {
            padding: 30px 0;
        }

        table .descricao {
            font-size: 9pt;
            font-weight: 400;
        }

        .values {
            font-size: 10pt;
        }

        .values #subtotal p,
        #total p {
            float: right;
            font-weight: 700;
            display: inline-block;
        }

        .values #taxa p {
            float: right;
            display: inline-block;
        }

        .values #taxa {
            left: 39%;
            position: relative;
        }

        .values #assinatura {
            text-align: right;
        }

        .values #assinatura #ep{
            color: #5B5B5B !important;
        }

        #hl {
            left: 55%;
            width: 45%;
            height: 2px;
            position: relative;
            background-color: rgb(0, 0, 0, 0.7);
        }

        .info {
            font-size: 10pt;
            margin-bottom: -50px;
        }

        .info .marginb {
            margin-bottom: -5px;
        }

        .info .title {
            font-size: 12pt;
        }
    </style>
    <br>
    <div class="header row">
        <div class="col-md-6">
            <img src="{{public_path('/media/logo.png')}}" alt="Logótipo - Estudar Portugal">
        </div>
        <div class="col-md-6">
            <div class="text-right" id="text-beneficiario">
                <p class="mb-0" id="nome">{{$pagoresponsabilidade->beneficiario}}</p>
                <p class="marginb">Rua das Oliveiras Verdes</p>
                <p class="marginb">Edifício Amarelo, Nº13</p>
                <p>3100-231 - Leiria</p>
            </div>
        </div>
    </div>

    <table class="mt-2">
        <thead>
            <tr>
                <th class="ml-2">Descrição do pagamento</th>
                <th class="ml-2">Data de pagamento</th>
                <th class="ml-2">Valor</th>
            </tr>
        </thead>
        <tr>
            <td class="y-border">{{$pagoresponsabilidade->responsabilidade->fase->descricao}} <br>
                <p class="descricao mb-1">{{$pagoresponsabilidade->descricao}}</p>
            </td>
            <td class="y-border">{{date('d/m/Y', strtotime($pagoresponsabilidade->dataPagamento))}}</td>
            <td>{{str_replace('.', ',', $pagoresponsabilidade->valorPago)}}&euro;</td>
        </tr>
        <tr class="none">
            <td class="y-border"></td>
            <td class="y-border"></td>
            <td></td>
        </tr>
        <tr class="none">
            <td class="y-border"></td>
            <td class="y-border"></td>
            <td></td>
        </tr>
        <tr class="none">
            <td class="y-border"></td>
            <td class="y-border"></td>
            <td></td>
        </tr>
        <tr class="none">
            <td class="y-border"></td>
            <td class="y-border"></td>
            <td></td>
        </tr>
    </table>
    <br>
    <div class="values">
        <div id="subtotal">
            <p>{{number_format((float)$pagoresponsabilidade->valorPago, 2, ',', '')}}&euro;</p>
            <p style="margin-right:9rem;">Sub Total</p>
        </div>
        <br>
        <div id="taxa" class="mt-2">
            <p>N/A</p>
            <p style="margin-right:8rem;">Taxas adicionais</p>
        </div>
        <br><br><br>
        <div id="hl"></div>
        <div id="total" class="mt-2">
            <p>{{number_format((float)$pagoresponsabilidade->valorPago, 2, ',', '')}}&euro;</p>
            <p style="margin-right:8.5rem;">Valor total</p>
        </div>
        <br><br><br>
        <div id="assinatura" class="mt-3">
            <p class="font-weight-bold mb-0" style="font-size:11pt">{{Auth()->user()->admin->nome.' '.Auth()->user()->admin->apelido}}</p>
            <p class="mb-0" id="ep">Estudar Portugal</p>
        </div>
    </div>

    <div class="info">
        <div>
            <p class="font-weight-bold mb-1 title">Informações</p>
            <p class="marginb">Pagamento: #{{$pagoresponsabilidade->idPagoResp}}</p>
            <p class="marginb">Data de emissão: {{date("d/m/Y")}}</p>
        </div>
        <br>
        <div>
            <p class="font-weight-bold mb-1 title">Contactos</p>
            <p class="marginb">Rua de Leiria, 3000-241, Leiria</p>
            <p class="marginb">+351 244 523 698 | estudarportugal@gmail.com</p>
            <p class="marginb">www.estudarportugal.com</p>
        </div>
    </div>
</body>

</html>
