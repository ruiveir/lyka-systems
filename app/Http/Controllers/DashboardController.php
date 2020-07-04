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

        $AllNotifications = Notificacao::all();

        $this->NotController->getNotificacaoAniversario($AllNotifications);
        $this->NotController->getNotificacaoInicioProduto($AllNotifications);
        $this->NotController->getNotificacaoFaseAcaba($AllNotifications);
        $this->NotController->getNotificacaoDocFalta($AllNotifications);



        function folderSize ($dir)
        {
            $size = 0;

            foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
                $size += is_file($each) ? filesize($each) : folderSize($each);
            }

            return $size;
        }


        function formatSize($bytes){
            $kb = 1024;
            $mb = $kb * 1024;
            $gb = $mb * 1024;
            $tb = $gb * 1024;
            if (($bytes >= 0) && ($bytes < $kb)) {
            return $bytes . ' B';
            } elseif (($bytes >= $kb) && ($bytes < $mb)) {
            return ceil($bytes / $kb) . ' KB';
            } elseif (($bytes >= $mb) && ($bytes < $gb)) {
            return ceil($bytes / $mb) . ' MB';
            } elseif (($bytes >= $gb) && ($bytes < $tb)) {
            return ceil($bytes / $gb) . ' GB';
            } elseif ($bytes >= $tb) {
            return ceil($bytes / $tb) . ' TB';
            } else {
            return $bytes . ' B';
            }
        }


       $size = formatSize (folderSize(storage_path('app')));


        //$agends = Agenda::all();
        $agends = Agenda::where('idUser', Auth::user()->idUser)->get();
        /*whereDate('dataInicio', '<=',Carbon::today())->
            whereDate('dataFim', '>=',Carbon::today())->*/
        $todayAgends = Agenda:: whereDate('dataInicio', '<=',Carbon::now())->
        whereDate('dataFim', '>=',Carbon::now())
            ->get();

        if ($agends->isEmpty()) {
            $agends=null;
        }
        return view('dashboard.index', compact('agentes', 'clientes', 'universidades', 'size', 'agends','todayAgends'));
    }





}
