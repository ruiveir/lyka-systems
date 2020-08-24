<?php

namespace App;

use App\User;
use App\Notificacao;
use DateTime;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'User';
    protected $primaryKey = 'idUser';

    protected $fillable = [
        'email',
        'tipo',
        'password',
        '$idAdmin',
        '$idAgente',
        '$idCliente',
    ];

    public function admin(){
        return $this->belongsTo("App\Administrador","idAdmin","idAdmin");
    }

    public function agente(){
        return $this->belongsTo("App\Agente","idAgente","idAgente")->withTrashed();
    }

    public function cliente(){
        return $this->belongsTo("App\Cliente","idCliente","idCliente")->withTrashed();
    }

    public function contacto(){
        return $this->hasMany("App\Contacto","idUser","idUser");
    }

    public function getNotifications(){
        $notifications = null;
        $todasDatas = null;
        $allNotifications = $this->unreadNotifications;
        if($allNotifications){
            foreach($allNotifications as $notification){
                if(!$notification->read_at){
                    if($notification->type == "App\Notifications\BugReportSend"){
                        if(Auth()->user()->tipo == "admin"){
                            $notifications[] = $notification;
                        }
                    }else{
                        if($todasDatas){
                            $repete = false;
                            foreach($todasDatas as $data){
                                if($notification->data['dataComeco'] == $data){
                                    $repete = true;
                                }
                            }
                            if(!$repete){
                                $todasDatas[] = $notification->data['dataComeco'];
                            }
                        }else{
                            $todasDatas[] = $notification->data['dataComeco'];
                        }
                    }
                }
            }
            if($todasDatas){
                rsort($todasDatas);
                foreach($todasDatas as $data){
                    foreach($allNotifications as $notification){
                        if(!$notification->read_at){
                            if($notification->type != "App\Notifications\BugReportSend" && $notification->notifiable_id == Auth()->user()->idUser){
                                if($notification->data['dataComeco'] == $data){
                                    $dataNot = new DateTime($notification->data['dataComeco']);
                                    $DataHoje = new DateTime();
                                    $diff = (date_diff($DataHoje,$dataNot))->format("%R%a");
                                    if($diff <= 0){
                                        $notifications[] = $notification;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $notifications;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
