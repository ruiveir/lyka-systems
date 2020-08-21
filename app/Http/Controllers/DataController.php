<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Fase;
use App\Conta;
use App\Agente;
use App\Agenda;
use App\Produto;
use App\Cliente;
use App\Contacto;
use App\DocPessoal;
use App\DocNecessario;
use App\DocStock;
use App\FaseStock;
use App\Fornecedor;
use App\Biblioteca;
use App\RelFornResp;
use App\Notificacao;
use App\DocAcademico;
use App\ProdutoStock;
use App\DocTransacao;
use App\Universidade;
use App\Administrador;
use App\Responsabilidade;
use App\PagoResponsabilidade;


class DataController extends Controller
{
    public function createData(){

        /****************          Administradores          ****************/

        $admin = new Administrador;
        $admin->nome = 'Edgar';
        $admin->apelido = 'Cordeiro';
        $admin->genero = 'M';
        $admin->email = 'nill546@hotmail.com';
        $admin->dataNasc = date('Y-m-d',strtotime('17-04-1997'));
        $admin->fotografia = null;
        $admin->telefone1 = 919245453;
        $admin->telefone2 = null;
        $admin->save();

        $admin = new Administrador;
        $admin->nome = 'Neuza';
        $admin->apelido = 'Cordeiro';
        $admin->genero = 'F';
        $admin->email = 'nex543@hotmail.com';
        $admin->dataNasc = date('Y-m-d',strtotime('30-10-1999'));
        $admin->fotografia = null;
        $admin->telefone1 = 919200000;
        $admin->telefone2 = null;
        $admin->save();

        /********************          Agentes          ********************/

        $agente = new Agente;
        $agente->nome = 'José';
        $agente->apelido = 'Fernandes';
        $agente->genero = 'M';
        $agente->email = 'jose.fer@gmail.com';
        $agente->dataNasc = date('Y-m-d',strtotime('15-07-1990'));
        $agente->fotografia = null;
        $agente->morada = 'Rua dos Agentes, 1234 Amores';
        $agente->pais = 'Portugal';
        $agente->NIF = 123456789;
        $agente->num_doc = 123456789;
        $agente->telefone1 = 932354453;
        $agente->telefone2 = null;
        $agente->tipo = 'Agente';
        $agente->observacoes ="Lorem Ipsum Tuli creme";
        $agente->save();

        $agente = new Agente;
        $agente->nome = 'Michaela';
        $agente->apelido = 'Silva';
        $agente->genero = 'F';
        $agente->email = 'michaela@outlook.com';
        $agente->dataNasc = date('Y-m-d',strtotime('16-03-1993'));
        $agente->fotografia = null;
        $agente->morada = 'Bidoeira de Cima';
        $agente->pais = 'Portugal';
        $agente->NIF = '213455767';
        $agente->num_doc = 321654987;
        $agente->telefone1 = 932355555;
        $agente->telefone2 = null;
        $agente->tipo = 'Agente';
        $agente->observacoes ="Gosta de pão com manteiga";
        $agente->save();

        $agente = new Agente;
        $agente->nome = 'João';
        $agente->apelido = 'Gama';
        $agente->genero = 'M';
        $agente->email = 'gama.jonh@hotmail.com';
        $agente->dataNasc = date('Y-m-d',strtotime('15-07-1995'));
        $agente->fotografia = null;
        $agente->morada = 'Rua dos Agentes, 1274 Amores';
        $agente->pais = 'Portugal';
        $agente->NIF = '987654321';
        $agente->num_doc = 789456123;
        $agente->telefone1 = 963423423;
        $agente->telefone2 = null;
        $agente->tipo = 'Subagente';
        $agente->idAgenteAssociado = 1;
        $agente->observacoes ="Tem como hoby contar os riscos da estrada";
        $agente->save();

        /*******************          Clientes          ********************/

        $cliente = new Cliente;
        $cliente->nome = 'Tiago';
        $cliente->idAgente = 1;
        $cliente->apelido = 'Oliveira';
        $cliente->genero = 'M';
        $cliente->email = 'tiaveira@gmail.com';
        $cliente->telefone1 = 913432423;
        $cliente->telefone2 = null;
        $cliente->dataNasc = date('Y-m-d',strtotime('27-01-1995'));
        $cliente->paisNaturalidade = 'França';
        $cliente->morada = 'Rua francesa';
        $cliente->cidade = 'Paris';
        $cliente->moradaResidencia = 'Av. dos Combatentes n.34, 3300-303 Xixaria';
        $cliente->nomePai = 'João Oliveira';
        $cliente->telefonePai = 914535342;
        $cliente->emailPai = 'oliveira.joao@gmail.com';
        $cliente->nomeMae = null;
        $cliente->telefoneMae = null;
        $cliente->emailMae = null;
        $cliente->fotografia = null;
        $cliente->NIF = 3490587685;
        $cliente->IBAN = 'FR76 123 4321 1345678901 72';
        $cliente->nivEstudoAtual = "Estuda na Universidade";
        $cliente->nomeInstituicaoOrigem = 'Instituto Francês';
        $cliente->cidadeInstituicaoOrigem = 'Paris';
        $cliente->num_docOficial = '9845776436ZZ8';
        $cliente->validade_docOficial = date('Y-m-d',strtotime('27-01-1995'));
        $cliente->numPassaporte = "324234";
        $cliente->obsPessoais = null;
        $cliente->obsFinanceiras = null;
        $cliente->obsAcademicas = null;
        $cliente->estado = "Ativo";
        $cliente->editavel= true;
        $cliente->save();

        $cliente = new Cliente;
        $cliente->idAgente = 2;
        $cliente->nome = 'Katherine';
        $cliente->apelido = 'Romaria';
        $cliente->genero = 'F';
        $cliente->email = 'kathe@mail.ru';
        $cliente->telefone1 = 945345784;
        $cliente->telefone2 = null;
        $cliente->dataNasc = date('Y-m-d',strtotime('02-05-1998'));
        $cliente->paisNaturalidade = 'Rússia';
        $cliente->morada = 'Rua Russia';
        $cliente->cidade = 'Cidade Russa';
        $cliente->moradaResidencia = 'Av. dos Combatentes n.34, 3300-303 Xixaria';
        $cliente->nomePai = 'Arthem Romaria';
        $cliente->telefonePai = 932452343;
        $cliente->emailPai = 'arthem@mail.ru';
        $cliente->nomeMae = 'Vaness Romaria';
        $cliente->telefoneMae = 913343443;
        $cliente->emailMae = 'vaness@mail.ru';
        $cliente->fotografia = null;
        $cliente->NIF = 759456385645;
        $cliente->IBAN = 'RU76 123 4321 1345678901 72';
        $cliente->nivEstudoAtual = "Curso Tecnológico";
        $cliente->nomeInstituicaoOrigem = 'Instituto Russo';
        $cliente->cidadeInstituicaoOrigem = 'Cidade Russa';
        $cliente->cidadeInstituicaoOrigem = 'Paris';
        $cliente->num_docOficial = '61436534643DS4';
        $cliente->validade_docOficial = date('Y-m-d',strtotime('27-01-1993'));
        $cliente->numPassaporte = "345345345";
        $cliente->obsPessoais = null;
        $cliente->obsFinanceiras = null;
        $cliente->obsAcademicas = null;
        $cliente->estado = "Inativo";
        $cliente->editavel= true;
        $cliente->save();

        /********************          Contas          *********************/

        $conta = new Conta;
        $conta->descricao = 'CGD Leiria';
        $conta->instituicao = 'Caixa Geral de Depósitos';
        $conta->titular = 'Estudar Portugal';
        $conta->morada = 'Praça Goa Damäo e Diu, 2400 - 147 Leiria';
        $conta->numConta = rand(999999, 9999999999);
        $conta->IBAN = 'PT50 324 8251 1345678901 34';
        $conta->SWIFT = 'DS26E HD23D ASD55 62DS6 FWW23';
        $conta->contacto = '244 032 985';
        $conta->obsConta = null;
        $conta->save();

        $conta = new Conta;
        $conta->descricao = 'EuroBic Leiria';
        $conta->instituicao = 'EuroBic';
        $conta->titular = 'Estudar Portugal';
        $conta->morada = 'R. 25 de Abril 168, 2415-602 Leiria';
        $conta->numConta = rand(999999, 9999999999);
        $conta->IBAN = 'PT50 123 5543 1345678901 72';
        $conta->SWIFT = 'TR23R 89DSA GH1H2 KM22N T12G1';
        $conta->contacto = '244 023 034';
        $conta->obsConta = null;
        $conta->save();

        /*******************          Contactos          *******************/

        $contacto = new Contacto;
        $contacto->idUser = 1;
        $contacto->nome = 'Pedro Costa';
        $contacto->fotografia = null;
        $contacto->telefone1 = null;
        $contacto->telefone2 = null;
        $contacto->email = 'jonh@gmail.com';
        $contacto->fax = null;
        $contacto->observacao = null;
        $contacto->favorito = true;
        $contacto->save();

        $contacto = new Contacto;
        $contacto->idUser = 1;
        $contacto->nome = 'Maria Pedro';
        $contacto->fotografia = null;
        $contacto->telefone1 = 915642453;
        $contacto->telefone2 = null;
        $contacto->email = 'manie@hotmail.com';
        $contacto->fax = null;
        $contacto->observacao = null;
        $contacto->favorito = false;
        $contacto->save();

        /*****************          Fornecedores          ******************/

        $fornecedor = new Fornecedor;
        $fornecedor->nome = 'Táxi - Leiria';
        $fornecedor->morada = 'Rua Leiria, Leiria';
        $fornecedor->descricao = 'Taxista André Vieira';
        $fornecedor->contacto = '244 025 968';
        $fornecedor->save();

        $fornecedor = new Fornecedor;
        $fornecedor->nome = 'Embaixada de Portugal MX';
        $fornecedor->morada = 'Rua Monterrey, México';
        $fornecedor->descricao = 'Embaixada de Portugal - México';
        $fornecedor->contacto = 'embaixadaportugalmx@mail.com';
        $fornecedor->observacoes = 'Demoram muito tempo a responder... Não perder a esperança :)';
        $fornecedor->save();

        /****************          Produtos Stock          *****************/

        $produtostock = new ProdutoStock;
        $produtostock->descricao = 'Lic 4F fr';
        $produtostock->tipoProduto = 'Licenciatura';
        $produtostock->anoAcademico = '2020/2021';
        $produtostock->save();

        /******************          Fases Stock          ******************/

        $fasestock = new FaseStock;
        $fasestock->descricao = 'Inscricão';
        $fasestock->idProdutoStock = '1';
        $fasestock->save();

        $fasestock = new FaseStock;
        $fasestock->descricao = 'Matricula';
        $fasestock->idProdutoStock = '1';
        $fasestock->save();

        $fasestock = new FaseStock;
        $fasestock->descricao = 'Propinas';
        $fasestock->idProdutoStock = '1';
        $fasestock->save();

        $fasestock = new FaseStock;
        $fasestock->descricao = 'Final';
        $fasestock->idProdutoStock = '1';
        $fasestock->save();

        /******************          Docs Stock          *******************/

        $docstock = new DocStock;
        $docstock->tipo = 'Pessoal';
        $docstock->tipoDocumento = 'Doc. Oficial';
        $docstock->idFaseStock = 1;
        $docstock->save();

        $docstock = new DocStock;
        $docstock->tipo = 'Academico';
        $docstock->tipoDocumento = 'Certificado';
        $docstock->idFaseStock = 1;
        $docstock->save();

        $docstock = new DocStock;
        $docstock->tipo = 'Pessoal';
        $docstock->tipoDocumento = 'Passaporte';
        $docstock->idFaseStock = 2;
        $docstock->save();

        $docstock = new DocStock;
        $docstock->tipo = 'Pessoal';
        $docstock->tipoDocumento = 'Cartão Cidadão';
        $docstock->idFaseStock = 2;
        $docstock->save();

        $docstock = new DocStock;
        $docstock->tipo = 'Pessoal';
        $docstock->tipoDocumento = 'Carta Condução';
        $docstock->idFaseStock = 2;
        $docstock->save();

        $docstock = new DocStock;
        $docstock->tipo = 'Academico';
        $docstock->tipoDocumento = 'Exame Universitário';
        $docstock->idFaseStock = 4;
        $docstock->save();

        /*****************          Universidades          *****************/

        $universidade = new Universidade;
        $universidade->nome = 'Ipleiria - ESTG';
        $universidade->morada = 'Ao lado do shopping';
        $universidade->telefone = 1234235346;
        $universidade->email = 'estg.ipleiria.pt';
        $universidade->NIF = 7846575487;
        $universidade->IBAN = 'PT50 6573 4321 1345678901 72';
        $universidade->observacoes = null;
        $universidade->obsCursos = null;
        $universidade->obsCandidaturas = null;
        $universidade->save();

        $universidade = new Universidade;
        $universidade->nome = 'Universidade de Aveiro';
        $universidade->morada = 'Aveiro, Portugal';
        $universidade->telefone = 912345678;
        $universidade->email = 'aveiro@uni.pt';
        $universidade->NIF = 5478236541;
        $universidade->IBAN = 'PT50 8651 2364 0901678901 12';
        $universidade->observacoes = null;
        $universidade->obsCursos = null;
        $universidade->obsCandidaturas = null;
        $universidade->save();

        /*********************          Users          *********************/

        $user = new User;
        $user->email = 'nill546@hotmail.com';
        $user->tipo = 'admin';
        $user->password = Hash::make('teste1234');
        $user->auth_key = strtoupper(random_str(5));
        $user->estado = true;
        $user->slug = post_slug('Edgar Cordeiro');
        $user->idAdmin = 2;
        $user->idAgente = null;
        $user->idCliente = null;
        $user->save();

        $user = new User;
        $user->email = 'jose.fer@gmail.com';
        $user->tipo = 'agente';
        $user->password = Hash::make('teste1234');
        $user->auth_key = strtoupper(random_str(5));
        $user->estado = true;
        $user->slug = post_slug('José Fernandes');
        $user->idAdmin = null;
        $user->idAgente = 1;
        $user->idCliente = null;
        $user->save();

        $user = new User;
        $user->email = 'gama.jonh@hotmail.com';
        $user->tipo = 'agente';
        $user->password = Hash::make('teste1234');
        $user->auth_key = strtoupper(random_str(5));
        $user->estado = true;
        $user->slug = post_slug('João Gama');
        $user->idAdmin = null;
        $user->idAgente = 3;
        $user->idCliente = null;
        $user->save();

        $user = new User;
        $user->email = 'tiaveira@gmail.com';
        $user->tipo = 'cliente';
        $user->password = Hash::make('teste1234');
        $user->auth_key = strtoupper(random_str(5));
        $user->estado = true;
        $user->slug = post_slug('Tiago Oliveira');
        $user->idAdmin = null;
        $user->idAgente = null;
        $user->idCliente = 1;
        $user->save();

        /*******************          Produtos          ********************/

        $produto = new Produto;
        $produto->descricao = 'Licenciatura';
        $produto->tipo = 'Licenciatura';
        $produto->anoAcademico = 5;
        $produto->valorTotal = 1500;
        $produto->valorTotalAgente = 300;
        $produto->valorTotalSubAgente = null;
        $produto->idAgente = 1;
        $produto->idSubAgente = 3;
        $produto->idCliente = 1;
        $produto->idUniversidade1 = 1;
        $produto->idUniversidade2 = 2;
        $produto->save();

        $produto = new Produto;
        $produto->descricao = 'Mestrado';
        $produto->tipo = 'Mestrado';
        $produto->anoAcademico = 5;
        $produto->valorTotal = 1900;
        $produto->valorTotalAgente = 300;
        $produto->valorTotalSubAgente = null;
        $produto->idAgente = 2;
        $produto->idSubAgente = null;
        $produto->idCliente = 1;
        $produto->idUniversidade1 = 2;
        $produto->idUniversidade2 = 1;
        $produto->save();

        /*********************          Fases          *********************/

        $fase = new Fase;
        $fase->descricao = 'Inscrição';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('16-03-2020 15:00'));
        $fase->valorFase = 50;
        $fase->verificacaoPago = false;
        $fase->icon = 'cube';
        $fase->idProduto = 1;
        $fase->save();

        $fase = new Fase;
        $fase->descricao = 'Matrícula';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('06-09-2020 18:30'));
        $fase->valorFase = 300;
        $fase->verificacaoPago = false;
        $fase->icon = 'layers';
        $fase->idProduto = 1;
        $fase->save();

        $fase = new Fase;
        $fase->descricao = 'Propinas';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('25-09-2020 23:59'));
        $fase->valorFase = 1000;
        $fase->verificacaoPago = false;
        $fase->icon = 'school';
        $fase->idProduto = 1;
        $fase->save();

        $fase = new Fase;
        $fase->descricao = 'Final';
        $fase->dataVencimento = date('Y-m-d H:i',strtotime('01-07-2021 18:30'));
        $fase->valorFase = 150;
        $fase->verificacaoPago = false;
        $fase->icon = 'pie-chart';
        $fase->idProduto = 1;
        $fase->save();

        /***************          Responsabilidades          ***************/

        $responsabilidade = new Responsabilidade;
        $responsabilidade->valorCliente = 10;
        $responsabilidade->idCliente = 1;
        $responsabilidade->verificacaoPagoCliente = false;
        $responsabilidade->dataVencimentoCliente = date('Y-m-d H:i',strtotime('12-11-2020 23:59'));

        $responsabilidade->valorAgente = null;
        $responsabilidade->idAgente = 1;
        $responsabilidade->verificacaoPagoAgente = false;
        $responsabilidade->dataVencimentoAgente = null;

        $responsabilidade->valorSubAgente = null;
        $responsabilidade->idSubAgente = 1;
        $responsabilidade->verificacaoPagoSubAgente = false;
        $responsabilidade->dataVencimentoSubAgente = null;

        $responsabilidade->valorUniversidade1 = 40;
        $responsabilidade->idUniversidade1 = 1;
        $responsabilidade->verificacaoPagoUni1 = false;
        $responsabilidade->dataVencimentoUni1 = date('Y-m-d H:i',strtotime('05-08-2020 23:59'));

        $responsabilidade->valorUniversidade2 = null;
        $responsabilidade->idUniversidade2 = 2;
        $responsabilidade->verificacaoPagoUni2 = false;
        $responsabilidade->dataVencimentoUni2 = null;
        $responsabilidade->idFase = 1;
        $responsabilidade->save();


        $responsabilidade = new Responsabilidade;
        $responsabilidade->valorCliente = null;
        $responsabilidade->idCliente = 1;
        $responsabilidade->verificacaoPagoCliente = false;
        $responsabilidade->dataVencimentoCliente = null;

        $responsabilidade->valorAgente = 20;
        $responsabilidade->idAgente = 1;
        $responsabilidade->verificacaoPagoAgente = false;
        $responsabilidade->dataVencimentoAgente = date('Y-m-d H:i',strtotime('28-07-2020 23:59'));

        $responsabilidade->valorSubAgente = 10;
        $responsabilidade->idSubAgente = 3;
        $responsabilidade->verificacaoPagoSubAgente = false;
        $responsabilidade->dataVencimentoSubAgente = date('Y-m-d H:i',strtotime('22-07-2020 23:59'));

        $responsabilidade->valorUniversidade1 = 150;
        $responsabilidade->idUniversidade1 = 1;
        $responsabilidade->verificacaoPagoUni1 = false;
        $responsabilidade->dataVencimentoUni1 = date('Y-m-d H:i',strtotime('25-09-2020 23:59'));

        $responsabilidade->valorUniversidade2 = 10;
        $responsabilidade->idUniversidade2 = 2;
        $responsabilidade->verificacaoPagoUni2 = false;
        $responsabilidade->dataVencimentoUni2 = date('Y-m-d H:i',strtotime('25-09-2020 23:59'));
        $responsabilidade->idFase = 2;
        $responsabilidade->save();


        $responsabilidade = new Responsabilidade;
        $responsabilidade->valorCliente = 125;
        $responsabilidade->idCliente = 1;
        $responsabilidade->verificacaoPagoCliente = false;
        $responsabilidade->dataVencimentoCliente = date('Y-m-d H:i',strtotime('01-06-2020 23:59'));

        $responsabilidade->valorAgente = 55;
        $responsabilidade->idAgente = 1;
        $responsabilidade->verificacaoPagoAgente = false;
        $responsabilidade->dataVencimentoAgente = date('Y-m-d H:i',strtotime('25-09-2020 23:59'));

        $responsabilidade->valorSubAgente = null;
        $responsabilidade->idSubAgente = 1;
        $responsabilidade->verificacaoPagoSubAgente = false;
        $responsabilidade->dataVencimentoSubAgente = null;

        $responsabilidade->valorUniversidade1 = null;
        $responsabilidade->idUniversidade1 = 1;
        $responsabilidade->verificacaoPagoUni1 = false;
        $responsabilidade->dataVencimentoUni1 = null;

        $responsabilidade->valorUniversidade2 = null;
        $responsabilidade->idUniversidade2 = 2;
        $responsabilidade->verificacaoPagoUni2 = false;
        $responsabilidade->dataVencimentoUni2 = null;
        $responsabilidade->idFase = 3;
        $responsabilidade->save();


        $responsabilidade = new Responsabilidade;
        $responsabilidade->valorCliente = null;
        $responsabilidade->idCliente = 1;
        $responsabilidade->verificacaoPagoCliente = false;
        $responsabilidade->dataVencimentoCliente = null;

        $responsabilidade->valorAgente = null;
        $responsabilidade->idAgente = 1;
        $responsabilidade->verificacaoPagoAgente = false;
        $responsabilidade->dataVencimentoAgente = null;

        $responsabilidade->valorSubAgente = null;
        $responsabilidade->idSubAgente = 1;
        $responsabilidade->verificacaoPagoSubAgente = false;
        $responsabilidade->dataVencimentoSubAgente = null;

        $responsabilidade->valorUniversidade1 = 650;
        $responsabilidade->idUniversidade1 = 1;
        $responsabilidade->verificacaoPagoUni1 = false;
        $responsabilidade->dataVencimentoUni1 = date('Y-m-d H:i', strtotime('10-04-2020 23:59'));

        $responsabilidade->valorUniversidade2 = null;
        $responsabilidade->idUniversidade2 = 2;
        $responsabilidade->verificacaoPagoUni2 = false;
        $responsabilidade->dataVencimentoUni2 = null;
        $responsabilidade->idFase = 4;
        $responsabilidade->save();

        /*****************          Rel Forn Resp          *****************/

        $relacao = new RelFornResp;
        $relacao->valor = 82;
        $relacao->dataVencimento = date('Y-m-d H:i',strtotime('12-04-2020 23:59'));
        $relacao->idResponsabilidade = 2;
        $relacao->idFornecedor = 1;
        $relacao->save();

        $relacao = new RelFornResp;
        $relacao->valor = 120;
        $relacao->dataVencimento = date('Y-m-d H:i',strtotime('21-07-2020 23:59'));
        $relacao->idResponsabilidade = 4;
        $relacao->idFornecedor = 1;
        $relacao->save();

        $relacao = new RelFornResp;
        $relacao->valor = 14;
        $relacao->dataVencimento = date('Y-m-d H:i',strtotime('10-08-2020 23:59'));
        $relacao->idResponsabilidade = 4;
        $relacao->idFornecedor = 2;
        $relacao->save();

        /******************          Docs Necessarios          *******************/

        $docnecessario = new DocNecessario;
        $docnecessario->tipo = 'Pessoal';
        $docnecessario->tipoDocumento = 'Doc. Oficial';
        $docnecessario->idFase = 1;
        $docnecessario->save();

        $docnecessario = new DocNecessario;
        $docnecessario->tipo = 'Academico';
        $docnecessario->tipoDocumento = 'Certificado';
        $docnecessario->idFase = 1;
        $docnecessario->save();

        $docnecessario = new DocNecessario;
        $docnecessario->tipo = 'Pessoal';
        $docnecessario->tipoDocumento = 'Passaporte';
        $docnecessario->idFase = 2;
        $docnecessario->save();

        $docnecessario = new DocNecessario;
        $docnecessario->tipo = 'Pessoal';
        $docnecessario->tipoDocumento = 'Cartão Cidadão';
        $docnecessario->idFase = 2;
        $docnecessario->save();

        $docnecessario = new DocNecessario;
        $docnecessario->tipo = 'Pessoal';
        $docnecessario->tipoDocumento = 'Carta Condução';
        $docnecessario->idFase = 2;
        $docnecessario->save();

        $docnecessario = new DocNecessario;
        $docnecessario->tipo = 'Academico';
        $docnecessario->tipoDocumento = 'Exame Universitário';
        $docnecessario->idFase = 4;
        $docnecessario->save();

        /****************          Docs Academicos          ****************/
/*
        $docacademico = new DocAcademico;
        $docacademico->nome = 'Tiago Oliveira';
        $docacademico->tipo = 'Certificado';
        $docacademico->imagem = 'DocAcademico-001-001-Certificado';
        $docacademico->pais = 'Paris';
        $docacademico->nota = 16;
        $docacademico->pontuacao = '0/20';
        $docacademico->verificacao = false;
        $docacademico->idFase = 1;
        $docacademico->save();

        /*****************          Docs Pessoais          *****************/

/*         $docpessoal = new DocPessoal;
        $docpessoal->idCliente = 1;
        $docpessoal->tipo = "Doc. Oficial";
        $docpessoal->imagem =null;
        $docpessoal->info = '{"numDoc":"9845776436ZZ8"}' ;
        $docpessoal->dataValidade = "2021-01-27";
        $docpessoal->idFase = '1';
        $docpessoal->save();


        $docpessoal = new DocPessoal;
        $docpessoal->idCliente = 1;
        $docpessoal->tipo = "Passaporte";
        $docpessoal->imagem =null;
        $docpessoal->info = '{"numPassaporte":"324234","dataValidPP":"2021-01-27","passaportPaisEmi":"França","localEmissaoPP":"Paris"}' ;
        $docpessoal->dataValidade = "2021-01-27";
        $docpessoal->idFase = '2';
        $docpessoal->save(); */

        /****************          Docs Transacoes          ****************/

        /*$doctransacao = new DocTransacao;
        $doctransacao->descricao = '';
        $doctransacao->valorRecebido = '';
        $doctransacao->dataOperacao = '';
        $doctransacao->dataRecebido = '';
        $doctransacao->verificacao = '';
        $doctransacao->imagem = '';
        $doctransacao->idConta = '';
        $doctransacao->idFase = '';
        $doctransacao->save();*/

    }
}
