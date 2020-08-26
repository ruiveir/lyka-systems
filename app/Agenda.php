<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use SoftDeletes;

    protected $table = 'Agenda';

    protected $primaryKey = 'idAgenda';

    protected $fillable = [
        'idUniversidade',
        'titulo',
        'descricao',
        'cor',
        'visibilidade',
        'dataInicio',
        'dataFim',
        '$idUser'
    ];

    public function user(){
        return $this->belongsTo("App\User","idUser","idUser")->withTrashed();
    }
}
