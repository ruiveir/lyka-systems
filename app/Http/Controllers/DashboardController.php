<?php
namespace App\Http\Controllers;

use Mail;
use App\Agenda;
use App\Agente;
use App\Cliente;
use Carbon\Carbon;
use App\Notificacao;
use App\Universidade;
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
        $clientes = Cliente::all();
        $universidades = Universidade::all()->count();

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

        return view('dashboard.index', compact('agentes', 'clientes', 'universidades', 'events'));
    }
}
