<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;
use DateInterval;

use App\Fase;
use App\Cliente;
use App\Notificacao;
use App\Produto;
use App\RelatorioProblema;
use App\Notifications\Adicionado;
use App\Notifications\Aniversario;
use App\Notifications\Atraso;
use App\Notifications\AtrasoCliente;
use App\Notifications\BugReportSend;


class NotificationController extends Controller
{
    public function getNotificacaoAniversario()
    {
        $notificacoes = Auth()->user()->unreadNotifications;
        if(!Auth()->user()){
            return null;
        }
        $Assunto = null;
        $dataNasc = null;
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $Admin = Auth()->user()->admin;
            $dataNasc = new DateTime($Admin->dataNasc);
            $Assunto = 'Parabéns '.Auth()->user()->admin->nome.' '.Auth()->user()->admin->apelido.'!';
        }
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null){
            $Agente = Auth()->user()->agente;
            $dataNasc = new DateTime($Agente->dataNasc);
            $Assunto = 'Parabéns '.Auth()->user()->agente->nome.' '.Auth()->user()->agente->apelido.'!';
        }
        if(Auth()->user()->tipo == 'cliente' && Auth()->user()->idCliente != null){
            $Cliente = Auth()->user()->cliente;
            $dataNasc = new DateTime($Cliente->dataNasc);
            $Assunto = 'Parabéns '.Auth()->user()->cliente->nome.' '.Auth()->user()->cliente->apelido.'!';
        }
        $DataHoje = new DateTime();
        if($dataNasc){
            $ano = $DataHoje->format("Y");
            $mes = $dataNasc->format("m");
            $dia =$dataNasc->format("d");
            $newDate = new DateTime($ano.'-'.$mes.'-'.$dia);

            $diff = (date_diff($newDate,$DataHoje))->format("%R%a");
            //dd($diff);
            if($diff > 0){
                $newDate = new DateTime(($ano+1).'-'.$mes.'-'.$dia);
            }
            $diff = (date_diff($DataHoje,$newDate))->format("%R%a");
            if($diff >= 0 && $diff <= 20){
                $Descricao = 'Hoje um ciclo de sua vida se finaliza e outro recomeça. Faça deste novo recomeço uma nova oportunidade para fazer tudo o que sempre sonhou! \nParabéns!';

                $date = $DataHoje;
                if($diff != 0){
                    $date = (new DateTime())->add(new DateInterval('P'.str_replace('+','',$diff).'D'));
                }
                $code = Auth()->user()->idUser.'_aniversario_'.$date->format('d-m-Y');
                $existe=false;
                if($notificacoes){
                    foreach($notificacoes as $notification){
                        if($notification->type == "App\Notifications\Aniversario"){
                            if($notification->data["code"] == $code){
                                $existe = true;
                            }
                        }
                    }
                }
                if(!$existe){
                    $Notdate = new DateTime();
                    if($diff != 0){
                        $Notdate = (new DateTime())->add(new DateInterval('P'.str_replace('+','',$diff).'D'));
                    }
                    Auth()->user()->notify(new Aniversario($code,false,$Notdate->format('Y-m-d'),'Aniversario',null,null,$Assunto,$Descricao));
                }
            }
        }
    }
    public function getNotificacaoInicioProduto()
    {
        /*************************** NOTIFICAÇÕES PARA INICIO PRODUTOS **************************/

    }
    public function getNotificacaoBugReport()
    {
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $relatorios = RelatorioProblema::where("estado","!=","Resolvido")->get();
            $notificacoes = Auth()->user()->unreadNotifications;

            foreach($relatorios as $relatorio){
                $notExiste = false;
                foreach($notificacoes as $not){
                    if($not->type == "App\Notifications\BugReportSend"){
                        if($not->data["idReport"] == $relatorio->idRelatorioProblema){
                            $notExiste = true;
                        }
                    }
                }
                if($notExiste == false){
                    Auth()->user()->notify(new BugReportSend($relatorio->nome, $relatorio->idRelatorioProblema));
                }
            }
            foreach($notificacoes as $not){
                $relExiste = false;
                if($not->type == "App\Notifications\BugReportSend"){
                    foreach($relatorios as $relatorio){
                        if($not->data["idReport"] == $relatorio->idRelatorioProblema){
                            $relExiste = true;
                        }
                    }
                    if($relExiste == false){
                        $not->delete();
                    }
                }
            }
        }

    }
    public function getNotificacaoFaseAcaba()
    {
        $notificacoes = Auth()->user()->unreadNotifications;
        $Fases = null;
        $Assunto = 'Clientes com documentos ou pagamentos em atraso!';
        $Descricao = null;
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null){
            $todasFases = Fase::where('dataVencimento','<=',(new DateTime())->add(new DateInterval('P7D')))
                ->get()->all();
            $agenteProdutos = null;
            if(Auth()->user()->agente->tipo == "Agente"){
                $agenteProdutos = Auth()->user()->agente->produtoA->all();
            }else{
                $agenteProdutos = Auth()->user()->agente->produtoSubA->all();
            }
            if($agenteProdutos && $todasFases){
                foreach($agenteProdutos as $produto){
                    $fasesProduto = $produto->fase->all();
                    foreach($todasFases as $fase){
                        foreach($fasesProduto as $faseP){
                            if($faseP == $fase){
                                $DocsAcademicos = $fase->docAcademico->where('verificacao','=',0)->all();
                                $DocsPessoais = $fase->docPessoal->where('verificacao','=',0)->all();
                                if(count($DocsAcademicos) >=1 || count($DocsAcademicos) >=1 || $fase->verificacaoPago == 0){
                                    if($Fases){
                                        $existe = false;
                                        foreach($Fases as $f){
                                            if($f->produto->cliente == $fase->produto->cliente){
                                                $existe = true;
                                            }
                                        }
                                        if(!$existe){
                                            $Fases[] = $fase;
                                        }
                                    }else{
                                        $Fases[] = $fase;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null){
            $todasFases = Fase::where('dataVencimento','<=',(new DateTime())->add(new DateInterval('P7D')))
                ->get()->all();
            $Produtos = Produto::all();
            if($Produtos && $todasFases){
                foreach($Produtos as $produto){
                    $fasesProduto = $produto->fase->all();
                    foreach($todasFases as $fase){
                        foreach($fasesProduto as $faseP){
                            if($faseP == $fase){
                                $DocsAcademicos = $fase->docAcademico->where('verificacao','=',0)->all();
                                $DocsPessoais = $fase->docPessoal->where('verificacao','=',0)->all();
                                if(count($DocsAcademicos) >=1 || count($DocsAcademicos) >=1 || $fase->verificacaoPago == 0){
                                    if($Fases){
                                        $existe = false;
                                        foreach($Fases as $f){
                                            if($f->produto->cliente == $fase->produto->cliente){
                                                $existe = true;
                                            }
                                        }
                                        if(!$existe){
                                            $Fases[] = $fase;
                                        }
                                    }else{
                                        $Fases[] = $fase;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        //dd($Fases);
        if($Fases){
            $urgencia = false;
            $Descricao = 'Clientes: ';
            $codecli = '';
            foreach($Fases as $fase){
                $produto = $fase->produto;
                $cliente = $produto->cliente;
                $codecli = $codecli.'_'.$cliente->idCliente;
                $dataVenc = (new DateTime($fase->dataVencimento));
                $DataHoje = new DateTime();
                $diff = (date_diff($dataVenc,$DataHoje))->format("%R%a");
                $Descricao = $Descricao.'\n - '.$cliente->nome.' '.$cliente->apelido.' -> '.(new DateTime($fase->dataVencimento))->format('d/m/Y');
                if($diff >= 0){
                    $urgencia = true;
                }
            }
            $code = Auth()->user()->idUser.'_atraso'.$codecli;
            $existe=false;
            if($notificacoes){
                foreach($notificacoes as $notification){
                    if($notification->type == "App\Notifications\Atraso"){
                        if($notification->data["code"] == $code && $notification->data["urgencia"] == $urgencia){
                            $existe = true;
                            $notifications = auth()->user()->readNotifications;
                            foreach($notifications as $not){
                                if($not->id == $notification->id){
                                    $not->markAsUnread();
                                }
                            }
                        }
                    }
                }
                if(!$existe){
                    foreach($notificacoes as $notification){
                        if($notification->type == 'App\Notifications\Atraso' && $notification->notifiable_id == Auth()->user()->idUser){
                            $notifications = auth()->user()->unreadNotifications;
                            foreach($notifications as $not){
                                if($not->id == $notification->id){
                                    $not->markAsRead();
                                }
                            }
                        }
                    }
                }
            }
            if(!$existe){
                Auth()->user()->notify(new Atraso($code,$urgencia,(new DateTime())->format('Y-m-d'),'Atraso',null,null,$Assunto,$Descricao));
            }
        }
    }

    public function getNotificacaoDocFalta()
    {
        $notificacoes = Auth()->user()->unreadNotifications;
        $FasesFalta = null;
        if(Auth()->user()->tipo == 'cliente' && Auth()->user()->idCliente != null){
            $produtosCliente = Auth()->user()->cliente->produto->all();
            $fasesCliente = null;
            foreach($produtosCliente as $produto){
                $fasesProduto = null;
                foreach($produto->fase as $fase){
                    if((new DateTime($fase->dataVencimento))>=(new DateTime()) && (new DateTime($fase->dataVencimento))<=((new DateTime())->add(new DateInterval('P14D')))){
                        $fasesProduto[] = $fase;
                    }
                }
                if($fasesProduto){
                    foreach($fasesProduto as $fase){
                        $fasesCliente[] = $fase;
                    }
                }
            }
            if($fasesCliente){
                foreach($fasesCliente as $fase){
                    $falta = false;
                    $docsAcademicos = $fase->docAcademico->where('verificacao','=',0)->all();
                    $docsPessoais = $fase->docPessoal->where('verificacao','=',0)->all();
                    if($fase->verificacaoPago = 0 || $docsAcademicos || $docsPessoais){
                        $falta = true;
                    }
                    if($falta){
                        $FasesFalta[] = $fase;
                    }
                }
            }
        }
        if($FasesFalta){
            foreach($FasesFalta as $Fase){
                $DocsAcademicos = $Fase->docAcademico->where('verificacao','=',0)->all();
                $DocsPessoais = $Fase->docPessoal->where('verificacao','=',0)->all();
                $novaNot = null;
                $Assunto = null;
                $Descricao = null;
                $existe = false;
                $urgencia = false;
                $dataVenc = (new DateTime($Fase->dataVencimento));
                $DataHoje = new DateTime();
                $diff = (date_diff($dataVenc,$DataHoje))->format("%R%a");
                $DataLimite = (new DateTime($Fase->dataVencimento));
                if($diff <= 0){
                    $urgencia = true;
                    $DataLimite = new DateTime($Fase->dataVencimento);
                }
                $NumDocumentos = count($DocsAcademicos) + count($DocsPessoais);
                if($Fase->verificacaoPago == 0 && $NumDocumentos >= 1){
                    $Assunto = 'Pagamento e documentos em Falta';
                    $Descricao = 'Pagamento em falta: \n - '.$Fase->descricao.' -> '.$Fase->valorFase.'€ \n\nDocumentos em Falta: \n - '.count($DocsAcademicos).' Documentos Académicos \n - '.count($DocsPessoais).' Documentos Pessoais';
                }else{
                    if($Fase->verificacaoPago == 0){
                        $Assunto = 'Pagamento em Falta';
                        $Descricao = 'Pagamento em falta: \n - '.$Fase->descricao.' -> '.$Fase->valorFase.'€';
                    }
                    if($NumDocumentos >= 1){
                        $Assunto = 'Documentos em Falta';
                        $Descricao = 'Documentos em Falta: \n - '.count($DocsAcademicos).' Documentos Académicos \n - '.count($DocsPessoais).' Documentos Pessoais';
                    }
                }
                $pagamento =0;
                if($Fase->verificacaoPago == 0){
                    $pagamento = 1;
                }
                $code = Auth()->user()->idUser.'_atrasoCliente_'.$Fase->idFase.'_'.$NumDocumentos.'_'.$pagamento;
                if($notificacoes){
                    foreach($notificacoes as $notification){
                        if($notification->type == 'App\Notifications\AtrasoCliente'){
                            if($notification->data["code"] == $code){
                                $existe = true;
                                $notifications = auth()->user()->readNotifications;
                                foreach($notifications as $not){
                                    if($not->id == $notification->id){
                                        $not->markAsUnread();
                                    }
                                }
                            }
                        }
                    }
                    if(!$existe){
                        foreach($notificacoes as $notification){
                            if($notification->type == 'App\Notifications\AtrasoCliente' && $notification->notifiable_id == Auth()->user()->idUser){
                                $notifications = auth()->user()->unreadNotifications;
                                foreach($notifications as $not){
                                    if($not->id == $notification->id){
                                        $not->markAsRead();
                                    }
                                }
                            }
                        }
                    }
                }
                if(!$existe){
                    Auth()->user()->notify(new AtrasoCliente($code,$urgencia,(new DateTime())->format('Y-m-d'),'AtrasoCliente',null,$DataLimite,$Assunto,$Descricao));
                }
            }
        }
    }


    public function index()
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null){
            $notifications = Auth()->user()->getNotifications();
            $relatorios = RelatorioProblema::all();
            return view('notifications.list', compact('notifications','relatorios'));
        }else{
            abort(403);
        }
    }

    public function show($notif_id)
    {
        if (Auth()->user()->tipo == "admin" && Auth()->user()->idAdmin != null){
            $notifications = Auth()->user()->getNotifications();
            $notification = null;
            foreach($notifications as $not){
                if($not->id == $notif_id){
                    $notification = $not;
                }
            }
            if($notification){
                $deleteNot = $notification;
                $deleteNot->delete();
            }
            $clientesNotificacao = Cliente::all();
            return view('notifications.show', compact('notification','clientesNotificacao'));
        }else{
            abort(403);
        }
    }
}
