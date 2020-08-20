<?php
namespace App\Http\Controllers;

use App\Agenda;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Agente;
use App\Cliente;
use App\Notificacao;
use App\Universidade;
use App\RelatorioProblema;
use Illuminate\Http\Request;
use App\Mail\ReportProblemMail;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller{

    protected $NotController;

    public function __construct(NotificationController $NotController)
    {
        $this->middleware('auth');
        $this->NotController = $NotController;
    }

    public function index(){
        $agentes = Agente::all();
        $clientes = Cliente::all();
        $universidades = Universidade::all();

        $this->NotController->getNotificacaoAniversario();
        $this->NotController->getNotificacaoInicioProduto();
        $this->NotController->getNotificacaoFaseAcaba();
        $this->NotController->getNotificacaoDocFalta();
        $this->NotController->getNotificacaoBugReport();

        return view('dashboard.index', compact('agentes', 'clientes', 'universidades'));
    }
}
