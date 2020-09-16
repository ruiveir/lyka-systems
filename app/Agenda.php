<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $primaryKey = 'agenda_id';

    protected $fillable = [
        'idUniversidade',
        'titulo',
        'descricao',
        'cor',
        'visibilidade',
        'data_inicio',
        'data_fim',
        '$idUser'
    ];

    public function user(){
        return $this->belongsTo("App\User", "idUser", "idUser")->withTrashed();
    }
}
