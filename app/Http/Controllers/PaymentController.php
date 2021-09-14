<?php
namespace App\Http\Controllers;

use App;
use PDF;
use DateTime;
use App\Fase;
use App\Conta;
use App\Agente;
use App\Produto;
use App\Cliente;
use Carbon\Carbon;
use App\Fornecedor;
use App\RelFornResp;
use App\Universidade;
use App\DocTransacao;
use App\Responsabilidade;
use App\Events\StorePayment;
use Illuminate\Http\Request;
use App\PagoResponsabilidade;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('superadmin');
    }

    public function index()
    {
        $responsabilidades = Responsabilidade::orderByRaw("FIELD(estado, \"Dívida\", \"Pendente\", \"Pago\")")
        ->with(["cliente", "agente", "universidade1", "relacao", "relacao.fornecedor", "fase", "pagoResponsabilidade"])
        ->get();

        $relacoes = RelFornResp::all();
        $currentdate = new DateTime();

        $responsabilidadesPendentes = 0;
        $responsabilidadesPagas = 0;
        $responsabilidadesDivida = 0;

        foreach ($responsabilidades as $responsabilidade) {
            // Verificação do estado de pagamentos para com o estudante.
            if ($responsabilidade->valorCliente != null && $responsabilidade->verificacaoPagoCliente) {
                $responsabilidadesPagas++;
            } elseif ($responsabilidade->valorCliente != null && !$responsabilidade->verificacaoPagoCliente && $responsabilidade->dataVencimentoCliente > Carbon::now()) {
                $responsabilidadesPendentes++;
            } elseif ($responsabilidade->valorCliente != null && !$responsabilidade->verificacaoPagoCliente && $responsabilidade->dataVencimentoCliente < Carbon::now()) {
                $responsabilidadesDivida++;
            }

            // Verificação do estado de pagamentos para com o agente.
            if ($responsabilidade->valorAgente != null && $responsabilidade->verificacaoPagoAgente) {
                $responsabilidadesPagas++;
            } elseif ($responsabilidade->valorAgente != null && !$responsabilidade->verificacaoPagoAgente && $responsabilidade->dataVencimentoAgente > Carbon::now()) {
                $responsabilidadesPendentes++;
            } elseif ($responsabilidade->valorAgente != null && !$responsabilidade->verificacaoPagoAgente && $responsabilidade->dataVencimentoAgente < Carbon::now()) {
                $responsabilidadesDivida++;
            }

            // Verificação do estado de pagamentos para com a universidade principal.
            if ($responsabilidade->valorUniversidade1 != null && $responsabilidade->verificacaoPagoUni1) {
                $responsabilidadesPagas++;
            } elseif ($responsabilidade->valorUniversidade1 != null && !$responsabilidade->verificacaoPagoUni1 && $responsabilidade->dataVencimentoUni1 > Carbon::now()) {
                $responsabilidadesPendentes++;
            } elseif ($responsabilidade->valorUniversidade1 != null && !$responsabilidade->verificacaoPagoUni1 && $responsabilidade->dataVencimentoUni1 < Carbon::now()) {
                $responsabilidadesDivida++;
            }
        }

        // Verificação do estado de pagamentos para com o fornecedor externo.
        if (count($relacoes)) {
            foreach ($relacoes as $relacao) {
                if ($relacao->estado == 'Dívida' && !$relacao->verificacaoPago) {
                    $responsabilidadesDivida++;
                } elseif ($relacao->verificacaoPago) {
                    $responsabilidadesPagas++;
                } else {
                    $responsabilidadesPendentes++;
                }
            }
        }

        return view('payments.list', compact('responsabilidades', 'currentdate', 'responsabilidadesPendentes', 'responsabilidadesPagas', 'responsabilidadesDivida'));
    }

    public function search(Request $request)
    {
        $idEstudante = ($request->input('estudante') != 'default') ? $request->input('estudante') : null;
        $idAgente = ($request->input('agente') != 'default') ? $request->input('agente') : null;
        $idSubagente = ($request->input('subagente') != 'default') ? $request->input('subagente') : null;
        $idUniversidade = ($request->input('universidade') != 'default') ? $request->input('universidade') : null;
        $idUniversidadeSec = ($request->input('universidadesec') != 'default') ? $request->input('universidadesec') : null;
        $idFornecedor = ($request->input('fornecedor') != 'default') ? $request->input('fornecedor') : null;
        $dataInicio = $request->input('datainicio');
        $dataFim = $request->input('datafim');

        // Pesquisa de ESTUDANTES
        if ($idEstudante != null) {
            if ($idEstudante == 'todos') {
                $responsabilidades = Responsabilidade::select()->with(['cliente', 'fase']);
                if ($dataInicio != null) {
                    $responsabilidades->where('dataVencimentoCliente', '>=', $dataInicio);
                }
                if ($dataFim != null) {
                    $responsabilidades->where('dataVencimentoCliente', '<=', $dataFim);
                }
            } else {
                $responsabilidades = Responsabilidade::where('idCliente', $idEstudante)->select()->with(['cliente', 'cliente.user', 'fase']);
                if ($dataInicio != null) {
                    $responsabilidades->where('dataVencimentoCliente', '>=', $dataInicio);
                }
                if ($dataFim != null) {
                    $responsabilidades->where('dataVencimentoCliente', '<=', $dataFim);
                }
            }
        }

        // Pesquisa de AGENTES
        if ($idAgente != null) {
            if ($idAgente == 'todos') {
                $responsabilidades = Responsabilidade::select()->with(["agente", "fase"]);
                if ($dataInicio != null) {
                    $responsabilidades->where('dataVencimentoAgente', '>=', $dataInicio);
                }
                if ($dataFim != null) {
                    $responsabilidades->where('dataVencimentoAgente', '<=', $dataFim);
                }
            } else {
                $responsabilidades = Responsabilidade::where('idAgente', $idAgente)->select()->with(["agente", "fase"]);
                if ($dataInicio != null) {
                    $responsabilidades->where('dataVencimentoAgente', '>=', $dataInicio);
                }
                if ($dataFim != null) {
                    $responsabilidades->where('dataVencimentoAgente', '<=', $dataFim);
                }
            }
        }

        /*/ Pesquisa de SUBAGENTES
        if ($idSubagente != null) {
            if ($idSubagente == 'todos') {
                $responsabilidades = Responsabilidade::select()->with(["subAgente", "fase"]);
                if ($dataInicio != null) {
                    $responsabilidades->where('dataVencimentoSubAgente', '>=', $dataInicio);
                }
                if ($dataFim != null) {
                    $responsabilidades->where('dataVencimentoSubAgente', '<=', $dataFim);
                }
            } else {
                $responsabilidades = Responsabilidade::where('idSubAgente', $idSubagente)->select()->with(["subAgente", "fase"]);
                if ($dataInicio != null) {
                    $responsabilidades->where('dataVencimentoSubAgente', '>=', $dataInicio);
                }
                if ($dataFim != null) {
                    $responsabilidades->where('dataVencimentoSubAgente', '<=', $dataFim);
                }
            }
        }
        */

        // Pesquisa de UNIVERSIDADE PRINCIPAL
        if ($idUniversidade != null) {
            if ($idUniversidade == 'todos') {
                $responsabilidades = Responsabilidade::select()->with(["universidade1", "fase"]);
                if ($dataInicio != null) {
                    $responsabilidades->where('dataVencimentoUni1', '>=', $dataInicio);
                }
                if ($dataFim != null) {
                    $responsabilidades->where('dataVencimentoUni1', '<=', $dataFim);
                }
            } else {
                $responsabilidades = Responsabilidade::where('idUniversidade1', $idUniversidade)->select()->with(["universidade1", "fase"]);
                if ($dataInicio != null) {
                    $responsabilidades->where('dataVencimentoUni1', '>=', $dataInicio);
                }
                if ($dataFim != null) {
                    $responsabilidades>where('dataVencimentoUni1', '<=', $dataFim);
                }
            }
        }

        /*/ Pesquisa de UNIVERSIDADE SECUNDÁRIA
        if ($idUniversidadeSec != null) {
            if ($idUniversidadeSec == 'todos') {
                $responsabilidades = Responsabilidade::select()->with(["universidade2", "fase"]);
                if ($dataInicio != null) {
                    $responsabilidades->where('dataVencimentoUni2', '>=', $idUniversidadeSec);
                }
                if ($dataFim != null) {
                    $responsabilidades->where('dataVencimentoUni2', '<=', $idUniversidadeSec);
                }
            } else {
                $responsabilidades = Responsabilidade::where('idUniversidade2', $idUniversidadeSec)->select()->with(["universidade2", "fase"]);
                if ($dataInicio != null) {
                    $responsabilidades->where('dataVencimentoUni2', '>=', $idUniversidadeSec);
                }
                if ($dataFim != null) {
                    $responsabilidades>where('dataVencimentoUni2', '<=', $idUniversidadeSec);
                }
            }
        }
        */

        // Pesquisa de FORNECEDORES
        if ($idFornecedor != null) {
            if ($idFornecedor == 'todos') {
                $responsabilidades = RelFornResp::where('idFornecedor', '!=', null)
          ->with(["fornecedor", "responsabilidade", "responsabilidade.fase"]);
                if ($dataInicio != null) {
                    $responsabilidades->where('dataVencimento', '>=', $dataInicio);
                }
                if ($dataFim != null) {
                    $responsabilidades->where('dataVencimento', '<=', $dataFim);
                }
            } else {
                $responsabilidades = RelFornResp::where('idFornecedor', $idFornecedor)
          ->with(["fornecedor", "responsabilidade", "responsabilidade.fase"]);
                if ($dataInicio != null) {
                    $responsabilidades->where('dataVencimento', '>=', $dataInicio);
                }
                if ($dataFim != null) {
                    $responsabilidades->where('dataVencimento', '<=', $dataFim);
                }
            }
        }

        $responsabilidades = $responsabilidades->get();

        if (count($responsabilidades)) {
            return response()->json($responsabilidades, 200);
        } else {
            return response()->json('NOK', 404);
        }
    }

    // Criação das vistas com as variáveis necessárias para criar um registo de um pagamento
    // As funções são diferentes pois as vistas são diferentes, bem como a informção que contêm.
    public function createcliente(Cliente $cliente, Fase $fase, Responsabilidade $responsabilidade)
    {
        $pagoResponsabilidade = new PagoResponsabilidade;
        $contas = Conta::all();
        $fase = Fase::where('idFase', $fase->idFase)->with(["produto", "produto.universidade1", "produto.agente"])->first();
        return view('payments.add', compact('cliente', 'fase', 'responsabilidade', 'contas', 'pagoResponsabilidade'));
    }

    public function createagente(Agente $agente, Fase $fase, Responsabilidade $responsabilidade)
    {
        $pagoResponsabilidade = new PagoResponsabilidade;
        $contas = Conta::all();
        $fase = Fase::where('idFase', $fase->idFase)->with(["produto", "produto.universidade1", "produto.cliente"])->first();
        return view('payments.add', compact('agente', 'fase', 'responsabilidade', 'contas', 'pagoResponsabilidade'));
    }

    public function createuni1(Universidade $universidade1, Fase $fase, Responsabilidade $responsabilidade)
    {
        $pagoResponsabilidade = new PagoResponsabilidade;
        $contas = Conta::all();
        $fase = Fase::where('idFase', $fase->idFase)->with(["produto", "produto.agente", "produto.cliente"])->first();
        return view('payments.add', compact('universidade1', 'fase', 'responsabilidade', 'contas', 'pagoResponsabilidade'));
    }

    public function createfornecedor(Fornecedor $fornecedor, Fase $fase, RelFornResp $relacao)
    {
        $pagoResponsabilidade = new PagoResponsabilidade;
        $contas = Conta::all();
        $responsabilidade = $relacao->responsabilidade;
        $fase = Fase::where('idFase', $fase->idFase)->with(["produto", "produto.agente", "produto.cliente", "produto.universidade1", "responsabilidade"])->first();
        return view('payments.add', compact('fornecedor', 'fase', 'contas', 'relacao', 'pagoResponsabilidade', 'responsabilidade'));
    }

    // Função para registar os pagamentos. Funciona com AJAX.
    // Os requests estão isolados por o tipo de categoria de pagamento (Cliente, Agente, ...)
    public function store(Request $request, Responsabilidade $responsabilidade)
    {
        $responsabilidade = Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->with(["cliente", "agente", "universidade1", "fase"])->first();
        // Campos de CLIENTE
        $valorCliente = ($request->input('valorPagoCliente') != null ? $request->input('valorPagoCliente') : null);
        $comprovativoCliente = ($request->file('comprovativoPagamentoCliente') != null ? $request->file('comprovativoPagamentoCliente') : null);
        $dataCliente = ($request->input('dataCliente') != null ? $request->input('dataCliente') : null);
        $contaCliente = ($request->input('contaCliente') != null ? $request->input('contaCliente') : null);
        $descricaoCliente = ($request->input('descricaoCliente') != null ? $request->input('descricaoCliente') : null);
        $observacoesCliente = ($request->input('observacoes') != null ? $request->input('observacoes') : null);
        // Campos de AGENTE
        $valorAgente = ($request->input('valorPagoAgente') != null ? $request->input('valorPagoAgente') : null);
        $comprovativoAgente = ($request->file('comprovativoPagamentoAgente') != null ? $request->file('comprovativoPagamentoAgente') : null);
        $dataAgente = ($request->input('dataAgente') != null ? $request->input('dataAgente') : null);
        $contaAgente = ($request->input('contaAgente') != null ? $request->input('contaAgente') : null);
        $descricaoAgente = ($request->input('descricaoAgente') != null ? $request->input('descricaoAgente') : null);
        $observacoesAgente = ($request->input('observacoes') != null ? $request->input('observacoes') : null);
        // Campos de UNIVERSIDADE1
        $valorUni1 = ($request->input('valorPagoUni1') != null ? $request->input('valorPagoUni1') : null);
        $comprovativoUni1 = ($request->file('comprovativoPagamentoUni1') != null ? $request->file('comprovativoPagamentoUni1') : null);
        $dataUni1 = ($request->input('dataUni1') != null ? $request->input('dataUni1') : null);
        $contaUni1 = ($request->input('contaUni1') != null ? $request->input('contaUni1') : null);
        $descricaoUni1 = ($request->input('descricaoUni1') != null ? $request->input('descricaoUni1') : null);
        $observacoesUni1 = ($request->input('observacoes') != null ? $request->input('observacoes') : null);
        // Campos de FORNECEDOR
        $valorFornecedor = ($request->input('valorPagoFornecedor') != null ? $request->input('valorPagoFornecedor') : null);
        $comprovativoFornecedor = ($request->file('comprovativoPagamentoForn') != null ? $request->file('comprovativoPagamentoForn') : null);
        $dataFornecedor = ($request->input('dataFornecedor') != null ? $request->input('dataFornecedor') : null);
        $contaFornecedor = ($request->input('contaFornecedor') != null ? $request->input('contaFornecedor') : null);
        $descricaoFornecedor = ($request->input('descricaoFornecedor') != null ? $request->input('descricaoFornecedor') : null);
        $observacoesFornecedor = ($request->input('observacoes') != null ? $request->input('observacoes') : null);
        $idRelacao = ($request->input('idRelacao') != null ? $request->input('idRelacao') : null);
        $nomeFornecedor = ($request->input('nomeFornecedor') != null ? $request->input('nomeFornecedor') : null);

        if ($valorCliente != null) {
            $pagoResponsabilidade = new PagoResponsabilidade;
            $pagoResponsabilidade->valorPago = str_replace(',', '.', $valorCliente);
            $pagoResponsabilidade->beneficiario = $responsabilidade->fase->produto->cliente->nome.' '.$responsabilidade->fase->produto->cliente->apelido;
            $pagoResponsabilidade->tipo_beneficiario = "Cliente";
            $pagoResponsabilidade->descricao = $descricaoCliente;
            $pagoResponsabilidade->observacoes = $observacoesCliente;
            $pagoResponsabilidade->dataPagamento = $dataCliente;
            if ($comprovativoCliente != null) {
                $ficheiroPagamento = $comprovativoCliente;
                $nomeFicheiro = 'pagamento-'.post_slug($responsabilidade->fase->produto->cliente->nome.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('comprovativos-pagamento/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            } else {
                $pagoResponsabilidade->comprovativoPagamento = null;
            }
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
            $pagoResponsabilidade->idConta = $contaCliente;
            $pagoResponsabilidade->save();

            if ($pagoResponsabilidade->valorPago >= $responsabilidade->valorCliente) {
                Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
                ->update(['verificacaoPagoCliente' => '1']);
            }
        }

        if ($valorAgente != null) {
            $pagoResponsabilidade = new PagoResponsabilidade;
            $pagoResponsabilidade->valorPago = str_replace(',', '.', $valorAgente);
            $pagoResponsabilidade->beneficiario = $responsabilidade->fase->produto->agente->nome.' '.$responsabilidade->fase->produto->agente->apelido;
            $pagoResponsabilidade->tipo_beneficiario = "Agente";
            $pagoResponsabilidade->dataPagamento = $dataAgente;
            $pagoResponsabilidade->descricao = $descricaoAgente;
            $pagoResponsabilidade->observacoes = $observacoesAgente;
            if ($comprovativoAgente != null) {
                $ficheiroPagamento = $comprovativoAgente;
                $nomeFicheiro = 'pagamento-'.post_slug($responsabilidade->fase->produto->agente->nome.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('comprovativos-pagamento/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            } else {
                $pagoResponsabilidade->comprovativoPagamento = null;
            }
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
            $pagoResponsabilidade->idConta = $contaAgente;
            $pagoResponsabilidade->save();

            if ($pagoResponsabilidade->valorPago >= $responsabilidade->valorAgente) {
                Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
                    ->update(['verificacaoPagoAgente' => '1']);
            }
        }

        if ($valorUni1 != null) {
            $pagoResponsabilidade = new PagoResponsabilidade;
            $pagoResponsabilidade->valorPago = str_replace(',', '.', $valorUni1);
            $pagoResponsabilidade->beneficiario = $responsabilidade->fase->produto->universidade1->nome;
            $pagoResponsabilidade->tipo_beneficiario = "UniPrincipal";
            $pagoResponsabilidade->dataPagamento = $dataUni1;
            $pagoResponsabilidade->descricao = $descricaoUni1;
            $pagoResponsabilidade->observacoes = $observacoesUni1;
            if ($comprovativoUni1 != null) {
                $ficheiroPagamento = $comprovativoUni1;
                $nomeFicheiro = 'pagamento-'.post_slug($responsabilidade->fase->produto->universidade1->nome.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('comprovativos-pagamento/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            } else {
                $pagoResponsabilidade->comprovativoPagamento = null;
            }
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
            $pagoResponsabilidade->idConta = $contaUni1;
            $pagoResponsabilidade->save();

            if ($pagoResponsabilidade->valorPago >= $responsabilidade->valorUniversidade1) {
                Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
            ->update(['verificacaoPagoUni1' => '1']);
            }
        }

        if ($valorFornecedor != null) {
            $relacao = RelFornResp::where('idRelacao', $idRelacao)->first();
            $pagoResponsabilidade = new PagoResponsabilidade;
            $pagoResponsabilidade->valorPago = str_replace(',', '.', $valorFornecedor);
            $pagoResponsabilidade->beneficiario = $nomeFornecedor;
            $pagoResponsabilidade->tipo_beneficiario = "Fornecedor";
            $pagoResponsabilidade->dataPagamento = $dataFornecedor;
            $pagoResponsabilidade->descricao = $descricaoFornecedor;
            $pagoResponsabilidade->observacoes = $observacoesFornecedor;
            if ($comprovativoFornecedor != null) {
                $ficheiroPagamento = $comprovativoFornecedor;
                $nomeFicheiro = 'pagamento'.post_slug($nomeFornecedor.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('comprovativos-pagamento/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            } else {
                $pagoResponsabilidade->comprovativoPagamento = null;
            }
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
            $pagoResponsabilidade->idConta = $contaFornecedor;
            $pagoResponsabilidade->save();

            dd($pagoResponsabilidade->valorPago >= $relacao->valor);

            if ($pagoResponsabilidade->valorPago >= $relacao->valor) {
                $relacao->update([
                    'verificacaoPago' => '1',
                    'estado' => 'Pago'
                ]);
            }
        }

        $responsabilidade = Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->first();
        event(new StorePayment($responsabilidade));
        return response()->json($pagoResponsabilidade, 200);
    }

    // Criação de vistas e variáveis para editar um pagamento já registados.
    // As funções estão separadas por razões semelhantes ao do registo de um pagamento.
    public function editcliente(Cliente $cliente, Fase $fase, Responsabilidade $responsabilidade, PagoResponsabilidade $pagoResponsabilidade)
    {
        $contas = Conta::all();
        return view('payments.edit', compact('cliente', 'fase', 'responsabilidade', 'contas', 'pagoResponsabilidade'));
    }

    public function editagente(Agente $agente, Fase $fase, Responsabilidade $responsabilidade, PagoResponsabilidade $pagoResponsabilidade)
    {
        $contas = Conta::all();
        return view('payments.edit', compact('agente', 'fase', 'responsabilidade', 'contas', 'pagoResponsabilidade'));
    }

    public function edituni1(Universidade $universidade1, Fase $fase, Responsabilidade $responsabilidade, PagoResponsabilidade $pagoResponsabilidade)
    {
        $contas = Conta::all();
        return view('payments.edit', compact('universidade1', 'fase', 'responsabilidade', 'contas', 'pagoResponsabilidade'));
    }

    public function editfornecedor(Fornecedor $fornecedor, Fase $fase, RelFornResp $relacao, PagoResponsabilidade $pagoResponsabilidade)
    {
        $contas = Conta::all();
        $responsabilidade = $relacao->responsabilidade;
        $fase = Fase::where('idFase', $fase->idFase)->with(["produto", "produto.agente", "produto.cliente", "produto.universidade1", "responsabilidade"])->first();
        return view('payments.edit', compact('fornecedor', 'fase', 'contas', 'relacao', 'pagoResponsabilidade', 'responsabilidade'));
    }

    // Função para editar os pagamentos. Funciona com AJAX.
    // Os requests estão isolados por o tipo de categoria de pagamento (Cliente, Agente, ...)
    public function update(Request $request, Responsabilidade $responsabilidade, PagoResponsabilidade $pagoResponsabilidade)
    {
        $responsabilidade = Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->with(["cliente", "agente", "subAgente", "universidade1", "universidade2", "fase"])->first();
        // Campos de CLIENTE
        $valorCliente = ($request->input('valorPagoCliente') != null ? $request->input('valorPagoCliente') : null);
        $comprovativoCliente = ($request->file('comprovativoPagamentoCliente') != null ? $request->file('comprovativoPagamentoCliente') : null);
        $dataCliente = ($request->input('dataCliente') != null ? $request->input('dataCliente') : null);
        $contaCliente = ($request->input('contaCliente') != null ? $request->input('contaCliente') : null);
        $descricaoCliente = ($request->input('descricaoCliente') != null ? $request->input('descricaoCliente') : null);
        $observacoesCliente = ($request->input('observacoes') != null ? $request->input('observacoes') : null);
        // Campos de AGENTE
        $valorAgente = ($request->input('valorPagoAgente') != null ? $request->input('valorPagoAgente') : null);
        $comprovativoAgente = ($request->file('comprovativoPagamentoAgente') != null ? $request->file('comprovativoPagamentoAgente') : null);
        $dataAgente = ($request->input('dataAgente') != null ? $request->input('dataAgente') : null);
        $contaAgente = ($request->input('contaAgente') != null ? $request->input('contaAgente') : null);
        $descricaoAgente = ($request->input('descricaoAgente') != null ? $request->input('descricaoAgente') : null);
        $observacoesAgente = ($request->input('observacoes') != null ? $request->input('observacoes') : null);
        // Campos de UNIVERSIDADE1
        $valorUni1 = ($request->input('valorPagoUni1') != null ? $request->input('valorPagoUni1') : null);
        $comprovativoUni1 = ($request->file('comprovativoPagamentoUni1') != null ? $request->file('comprovativoPagamentoUni1') : null);
        $dataUni1 = ($request->input('dataUni1') != null ? $request->input('dataUni1') : null);
        $contaUni1 = ($request->input('contaUni1') != null ? $request->input('contaUni1') : null);
        $descricaoUni1 = ($request->input('descricaoUni1') != null ? $request->input('descricaoUni1') : null);
        $observacoesUni1 = ($request->input('observacoes') != null ? $request->input('observacoes') : null);
        // Campos de FORNECEDOR
        $valorFornecedor = ($request->input('valorPagoFornecedor') != null ? $request->input('valorPagoFornecedor') : null);
        $comprovativoFornecedor = ($request->file('comprovativoPagamentoForn') != null ? $request->file('comprovativoPagamentoForn') : null);
        $dataFornecedor = ($request->input('dataFornecedor') != null ? $request->input('dataFornecedor') : null);
        $contaFornecedor = ($request->input('contaFornecedor') != null ? $request->input('contaFornecedor') : null);
        $descricaoFornecedor = ($request->input('descricaoFornecedor') != null ? $request->input('descricaoFornecedor') : null);
        $observacoesFornecedor = ($request->input('observacoes') != null ? $request->input('observacoes') : null);
        $idRelacao = ($request->input('idRelacao') != null ? $request->input('idRelacao') : null);
        $nomeFornecedor = ($request->input('nomeFornecedor') != null ? $request->input('nomeFornecedor') : null);

        if ($valorCliente != null) {
            $pagoResponsabilidade->valorPago = str_replace(',', '.', $valorCliente);
            $pagoResponsabilidade->beneficiario = $responsabilidade->fase->produto->cliente->nome.' '.$responsabilidade->fase->produto->cliente->apelido;
            $pagoResponsabilidade->descricao = $descricaoCliente;
            $pagoResponsabilidade->observacoes = $observacoesCliente;
            $pagoResponsabilidade->dataPagamento = $dataCliente;
            if ($comprovativoCliente != null) {
                $ficheiroPagamento = $comprovativoCliente;
                $nomeFicheiro = post_slug($responsabilidade->fase->produto->cliente->nome.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('comprovativos-pagamento/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            } else {
                $pagoResponsabilidade->comprovativoPagamento = null;
            }
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
            $pagoResponsabilidade->idConta = $contaCliente;
            $pagoResponsabilidade->save();

            if (str_replace(',', '.', $valorCliente) >= $responsabilidade->valorCliente) {
                Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
                ->update(['verificacaoPagoCliente' => '1']);
            }
        }

        if ($valorAgente != null) {
            $pagoResponsabilidade->valorPago = str_replace(',', '.', $valorAgente);
            $pagoResponsabilidade->beneficiario = $responsabilidade->fase->produto->agente->nome.' '.$responsabilidade->fase->produto->agente->apelido;
            $pagoResponsabilidade->dataPagamento = $dataAgente;
            $pagoResponsabilidade->descricao = $descricaoAgente;
            $pagoResponsabilidade->observacoes = $observacoesAgente;
            if ($comprovativoAgente != null) {
                $ficheiroPagamento = $comprovativoAgente;
                $nomeFicheiro = post_slug($responsabilidade->fase->produto->agente->nome.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('comprovativos-pagamento/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            } else {
                $pagoResponsabilidade->comprovativoPagamento = null;
            }
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
            $pagoResponsabilidade->idConta = $contaAgente;
            $pagoResponsabilidade->save();

            if ($valorAgente >= $responsabilidade->valorAgente) {
                Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
                    ->update(['verificacaoPagoAgente' => '1']);
            }
        }

        if ($valorUni1 != null) {
            $pagoResponsabilidade->valorPago = str_replace(',', '.', $valorUni1);
            $pagoResponsabilidade->beneficiario = $responsabilidade->fase->produto->universidade1->nome;
            $pagoResponsabilidade->dataPagamento = $dataUni1;
            $pagoResponsabilidade->descricao = $descricaoUni1;
            $pagoResponsabilidade->observacoes = $observacoesUni1;
            if ($comprovativoUni1 != null) {
                $ficheiroPagamento = $comprovativoUni1;
                $nomeFicheiro = post_slug($responsabilidade->fase->produto->universidade1->nome.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('comprovativos-pagamento/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            } else {
                $pagoResponsabilidade->comprovativoPagamento = null;
            }
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
            $pagoResponsabilidade->idConta = $contaUni1;
            $pagoResponsabilidade->save();

            if ($valorUni1 >= $responsabilidade->valorUniversidade1) {
                Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)
                ->update(['verificacaoPagoUni1' => '1']);
            }
        }

        if ($valorFornecedor != null) {
            $relacao = RelFornResp::where('idRelacao', $idRelacao)->first();
            $pagoResponsabilidade->valorPago = str_replace(',', '.', $valorFornecedor);
            $pagoResponsabilidade->beneficiario = $nomeFornecedor;
            $pagoResponsabilidade->dataPagamento = $dataFornecedor;
            $pagoResponsabilidade->descricao = $descricaoFornecedor;
            $pagoResponsabilidade->observacoes = $observacoesFornecedor;
            if ($comprovativoFornecedor != null) {
                $ficheiroPagamento = $comprovativoFornecedor;
                $nomeFicheiro = post_slug($nomeFornecedor.' '.$responsabilidade->fase->descricao).'-comprovativo-'.post_slug($responsabilidade->fase->idFase).'.'.$ficheiroPagamento->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('comprovativos-pagamento/', $ficheiroPagamento, $nomeFicheiro);
                $pagoResponsabilidade->comprovativoPagamento = $nomeFicheiro;
            } else {
                $pagoResponsabilidade->comprovativoPagamento = null;
            }
            $pagoResponsabilidade->idResponsabilidade = $responsabilidade->idResponsabilidade;
            $pagoResponsabilidade->idConta = $contaFornecedor;
            $pagoResponsabilidade->save();

            if ($valorFornecedor >= $relacao->valor) {
                $relacao->update([
                    'verificacaoPago' => '1',
                    'estado' => 'Pago'
                ]);
            }
        }

        $responsabilidade = Responsabilidade::where('idResponsabilidade', $responsabilidade->idResponsabilidade)->first();
        event(new StorePayment($responsabilidade));
        return response()->json($pagoResponsabilidade, 200);
    }

    // Criação das vistas com as variáveis necessárias para visualizar um pagamento já registado.
    // As funções são diferentes pois as vistas são diferentes, bem como a informção que contêm.
    public function showcliente(Cliente $cliente, Fase $fase, Responsabilidade $responsabilidade, PagoResponsabilidade $pagoResponsabilidade)
    {
        $pagoResponsabilidade = $pagoResponsabilidade->where([["tipo_beneficiario", "Cliente"], ["idResponsabilidade", $responsabilidade->idResponsabilidade]])->first();
        return view("payments.show", compact("cliente", "fase", "responsabilidade", "pagoResponsabilidade"));
    }

    public function showagente(Agente $agente, Fase $fase, Responsabilidade $responsabilidade, PagoResponsabilidade $pagoResponsabilidade)
    {
        $pagoResponsabilidade = $pagoResponsabilidade->where([["tipo_beneficiario", "Agente"], ["idResponsabilidade", $responsabilidade->idResponsabilidade]])->first();
        return view("payments.show", compact("agente", "fase", "responsabilidade", "pagoResponsabilidade"));
    }

    public function showuni1(Universidade $universidade1, Fase $fase, Responsabilidade $responsabilidade, PagoResponsabilidade $pagoResponsabilidade)
    {
        $pagoResponsabilidade = $pagoResponsabilidade->where([["tipo_beneficiario", "UniPrincipal"], ["idResponsabilidade", $responsabilidade->idResponsabilidade]])->first();
        return view('payments.show', compact('universidade1', 'fase', 'responsabilidade', 'pagoResponsabilidade'));
    }

    public function showfornecedor(Fornecedor $fornecedor, Fase $fase, RelFornResp $relacao, PagoResponsabilidade $pagoResponsabilidade)
    {
        $responsabilidade = $relacao->responsabilidade;
        $fase = Fase::where('idFase', $fase->idFase)->with(["produto", "produto.agente", "produto.cliente", "produto.universidade1", "responsabilidade"])->first();
        $pagoResponsabilidade = $pagoResponsabilidade->where([["tipo_beneficiario", "Fornecedor"], ["idResponsabilidade", $responsabilidade->idResponsabilidade]])->first();
        return view('payments.show', compact('fornecedor', 'fase', 'relacao', 'pagoResponsabilidade', 'responsabilidade'));
    }

    // Criação de uma nota de pagamento através do biblioteca DOM PFD.
    public function download(PagoResponsabilidade $pagoresponsabilidade)
    {
        $pagoresponsabilidade = PagoResponsabilidade::where("idPagoResp", $pagoresponsabilidade->idPagoResp)->with(["responsabilidade", "responsabilidade.cliente"])->first();
        $pdf = PDF::loadView('payments.pdf.nota-pagamento', ['pagoresponsabilidade' => $pagoresponsabilidade])->setPaper('a4', 'portrait');
        $file = post_slug($pagoresponsabilidade->responsabilidade->cliente->nome.' '.$pagoresponsabilidade->responsabilidade->fase->descricao);
        return $pdf->stream('nota-pagamento-'.$file.'.pdf');
    }

    public function downloadComprovativo(PagoResponsabilidade $pagoresponsabilidade)
    {
        return Storage::disk('public')->download('comprovativos-pagamento/'.$pagoresponsabilidade->comprovativoPagamento);
    }

    public function destroy(PagoResponsabilidade $pagoResponsabilidade)
    {
        switch ($pagoResponsabilidade->tipo_beneficiario) {
            case 'Cliente':
                Responsabilidade::where('idResponsabilidade', $pagoResponsabilidade->responsabilidade->idResponsabilidade)
                ->update(['verificacaoPagoCliente' => '0']);
                break;

            case 'Agente':
                Responsabilidade::where('idResponsabilidade', $pagoResponsabilidade->responsabilidade->idResponsabilidade)
                ->update(['verificacaoPagoAgente' => '0']);
                break;

            case 'UniPrincipal':
                Responsabilidade::where('idResponsabilidade', $pagoResponsabilidade->responsabilidade->idResponsabilidade)
                ->update(['verificacaoPagoUni1' => '0']);
                break;

            case 'Fornecedor':
                RelFornResp::where('idResponsabilidade', $pagoResponsabilidade->responsabilidade->idResponsabilidade)
                ->update(['verificacaoPago' => '0']);
                break;
        }
        Storage::disk('public')->delete('comprovativos-pagamento/'.$pagoResponsabilidade->comprovativoPagamento);
        $pagoResponsabilidade->delete();

        return redirect()->route('payments.index')->with('success', 'Pagamento anulado com sucesso.');
    }
}
