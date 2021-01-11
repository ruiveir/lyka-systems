<?php
namespace App\Http\Controllers;

use Mail;
use App\Fase;
use App\Agenda;
use App\Agente;
use App\Cliente;
use Carbon\Carbon;
use App\RelFornResp;
use App\Notificacao;
use App\Responsabilidade;
use App\RelatorioProblema;
use Illuminate\Http\Request;
use App\Mail\ReportProblemMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    protected $NotController;

    public function __construct(NotificationController $NotController)
    {
        $this->NotController = $NotController;
    }

    public function index()
    {
        $agentes = Agente::all()->count();
        $clientes = Cliente::all()->count();
        $cobrancas = Fase::where("estado", "Pendente")->count();
        $responsabilidades = Responsabilidade::all();
        $relacoes = RelFornResp::all();

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

            // Verificação do estado de pagamentos para com o subagente.
            if ($responsabilidade->valorSubAgente != null && $responsabilidade->verificacaoPagoSubAgente) {
                $responsabilidadesPagas++;
            } elseif ($responsabilidade->valorSubAgente != null && !$responsabilidade->verificacaoPagoSubAgente && $responsabilidade->dataVencimentoSubAgente > Carbon::now()) {
                $responsabilidadesPendentes++;
            } elseif ($responsabilidade->valorSubAgente != null && !$responsabilidade->verificacaoPagoSubAgente && $responsabilidade->dataVencimentoSubAgente < Carbon::now()) {
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

            // Verificação do estado de pagamentos para com a universidade secundária.
            if ($responsabilidade->valorUniversidade2 != null && $responsabilidade->verificacaoPagoUni2) {
                $responsabilidadesPagas++;
            } elseif ($responsabilidade->valorUniversidade2 != null && !$responsabilidade->verificacaoPagoUni2 && $responsabilidade->dataVencimentoUni2 > Carbon::now()) {
                $responsabilidadesPendentes++;
            } elseif ($responsabilidade->valorUniversidade2 != null && !$responsabilidade->verificacaoPagoUni2 && $responsabilidade->dataVencimentoUni2 < Carbon::now()) {
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

        $events = Agenda::where([
            ['data_fim', null],
            ['data_inicio', '>=', Carbon::now()]
        ])
        ->orWhere(function($query) {
            $query->where('data_fim', '!=', null)
                  ->where('data_fim', '>=', Carbon::now());
        })
        ->where(function($query) {
            $query->whereMonth('data_inicio', Carbon::now()->format('m'))
                  ->orWhereMonth('data_fim', Carbon::now()->format('m'));
        })
        ->orderBy('data_inicio', 'asc')
        ->get();

        $this->NotController->getNotificacaoAniversario();
        $this->NotController->getNotificacaoInicioProduto();
        $this->NotController->getNotificacaoFaseAcaba();
        $this->NotController->getNotificacaoDocFalta();
        $this->NotController->getNotificacaoBugReport();

        return view('dashboard.index', compact('agentes', 'clientes', 'cobrancas', 'responsabilidadesPendentes', 'events'));
    }
}
