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

        $AllNotifications = Notificacao::where("notifiable_id", "=",Auth()->user()->idUser)->get();

        $this->NotController->getNotificacaoAniversario($AllNotifications);
        $this->NotController->getNotificacaoInicioProduto($AllNotifications);
        $this->NotController->getNotificacaoFaseAcaba($AllNotifications);
        $this->NotController->getNotificacaoDocFalta($AllNotifications);

        
        $AllNotifications = Notificacao::where("notifiable_id", "=",Auth()->user()->idUser)->whereNull("read_at")->get();
        $this->NotController->getNotificacaoBugReport($AllNotifications);

        return view('dashboard.index', compact('agentes', 'clientes', 'universidades'));
    }
}
