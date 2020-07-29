<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;
use DateInterval;

use App\Fase;
use App\Notificacao;
use App\Notifications\Adicionado;
use App\Notifications\Aniversario;
use App\Notifications\Atraso;
use App\Notifications\AtrasoCliente;


class NotificationController extends Controller
{
    public function getNotificacaoAniversario($AllNotifications)
    {
        if(!Auth()->user()){
            return null;
        }
        $Assunto = null;
        $dataNasc = null;
        if(Auth()->user()->tipo == 'admin' && Auth()->user()->idAdmin != null && Auth()->user()->email != "admin@test.com"){
            $Admin = Auth()->user()->admin;
            $dataNasc = new DateTime($Admin->dataNasc);
            $Assunto = 'PARABÉNS '.Auth()->user()->admin->nome.' '.Auth()->user()->admin->apelido;
        }
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null){
            $Agente = Auth()->user()->agente;
            $dataNasc = new DateTime($Agente->dataNasc);
            $Assunto = 'PARABÉNS '.Auth()->user()->agente->nome.' '.Auth()->user()->agente->apelido;
        }
        if(Auth()->user()->tipo == 'cliente' && Auth()->user()->idCliente != null){
            $Cliente = Auth()->user()->cliente;
            $dataNasc = new DateTime($Cliente->dataNasc);
            $Assunto = 'PARABÉNS '.Auth()->user()->cliente->nome.' '.Auth()->user()->cliente->apelido;
        }
        $DataHoje = new DateTime();
        if($dataNasc){
            $diff = (date_diff($dataNasc,$DataHoje))->format("%R%a");
            if($diff >= 0 && $diff <= 20){
                $Descricao = 'Hoje um ciclo de sua vida se finaliza e outro recomeça. Faça deste novo recomeço uma nova oportunidade para fazer tudo o que sempre sonhou! \nParabéns!';
                $date = (new DateTime())->add(new DateInterval('P'.$diff.'D'));
                $code = Auth()->user()->idUser.'_aniversario_'.$date->format('d-m-Y');
                $existe=false;
                if($AllNotifications){
                    foreach($AllNotifications as $notification){
                        $dados = json_decode($notification->data);
                        if($dados->code == $code){
                            $existe = true;
                        }
                    }
                }
                if(!$existe){
                    $Notdate = (new DateTime())->add(new DateInterval('P'.$diff.'D'));
                    Auth()->user()->notify(new Aniversario($code,false,$Notdate->format('Y-m-d'),'Aniversario',null,null,$Assunto,$Descricao));
                }
            }
        }
    }
    public function getNotificacaoInicioProduto($AllNotifications)
    {
        /*************************** NOTIFICAÇÕES PARA INICIO PRODUTOS **************************/

    }
    public function getNotificacaoFaseAcaba($AllNotifications)
    {
        if(Auth()->user()->tipo == 'agente' && Auth()->user()->idAgente != null){
            $Fases = null;
            $Assunto = 'Clientes com documentos ou pagamentos em atraso';
            $Descricao = null;
            $todasFases = Fase::where('dataVencimento','<=',(new DateTime())->add(new DateInterval('P7D')))
                ->get()->all();
            $agenteProdutos = Auth()->user()->agente->produtoA->all();
            if($agenteProdutos && $todasFases){
                foreach($agenteProdutos as $produto){
                    $fasesProduto = $produto->fase->all();
                    foreach($todasFases as $fase){
                        foreach($fasesProduto as $faseP){
                            if($faseP == $fase){
                                $DocsAcademicos = $fase->docAcademico->where('verificacao','=',0)->all();
                                $DocsPessoais = $fase->docPessoal->where('verificacao','=',0)->all();
                                if(count($DocsAcademicos) >=1 || count($DocsAcademicos) >=1 || $fase->verificacaoPago == 0){
                                    $Fases[] = $fase;
                                }
                            }
                        }
                    }
                }
            }
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
                if($AllNotifications){
                    foreach($AllNotifications as $notification){
                        $dados = json_decode($notification->data);
                        if($dados->code == $code){
                            $existe = true;
                            auth()->user()->readNotifications->where('id','=',$notification->id)->markAsUnread();
                        }
                    }
                    if(!$existe){
                        foreach($AllNotifications as $notification){
                            if($notification->type == 'App\Notifications\Atraso' && $notification->notifiable_id == Auth()->user()->idUser){
                                auth()->user()->unreadNotifications->where('id','=',$notification->id)->markAsRead();
                            }
                        }
                    }
                }
                if(!$existe){
                    Auth()->user()->notify(new Atraso($code,$urgencia,(new DateTime())->format('Y-m-d'),'Atraso',null,null,$Assunto,$Descricao));
                }
            }
        }
    }
    public function getNotificacaoDocFalta($AllNotifications)
    {
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
                if($AllNotifications){
                    foreach($AllNotifications as $notification){
                        $dados = json_decode($notification->data);
                        if($dados->code == $code){
                            $existe = true;
                            auth()->user()->readNotifications->where('id','=',$notification->id)->markAsUnread();
                        }
                    }
                    if(!$existe){
                        foreach($AllNotifications as $notification){
                            if($notification->type == 'App\Notifications\AtrasoCliente' && $notification->notifiable_id == Auth()->user()->idUser){
                                auth()->user()->readNotifications->where('id','=',$notification->id)->markAsRead();
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
}

