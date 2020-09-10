<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsabilidade extends Model
{
    use SoftDeletes;
    protected $table = 'responsabilidade';
    protected $primaryKey = 'idResponsabilidade';

    protected $fillable = [
        'valorCliente',
        'valorAgente',
        'valorSubAgente',
        'valorUniversidade1',
        'valorUniversidade2',
        'verificacaoPagoCliente',
        'verificacaoPagoAgente',
        'verificacaoPagoSubAgente',
        'verificacaoPagoUni1',
        'verificacaoPagoUni2',
        '$idAgente',
        '$idSubAgente',
        '$idCliente',
        '$idUniversidade1',
        '$idUniversidade2',
        '$idFase'
    ];

    protected $dates = [
        'dataVencimentoCliente',
        'dataVencimentoAgente',
        'dataVencimentoSubAgente',
        'dataVencimentoUni1',
        'dataVencimentoUni2'
    ];

    public function cliente(){
        return $this->belongsTo("App\Cliente","idCliente","idCliente")->withTrashed();
    }

    public function agente(){
        return $this->belongsTo("App\Agente","idAgente","idAgente")->withTrashed();
    }

    public function subAgente(){
        return $this->belongsTo("App\Agente","idSubAgente","idAgente")->withTrashed();
    }

    public function universidade1(){
        return $this->belongsTo("App\Universidade","idUniversidade1","idUniversidade")->withTrashed();
    }

    public function universidade2(){
        return $this->belongsTo("App\Universidade","idUniversidade2","idUniversidade")->withTrashed();
    }

    public function fase(){
        return $this->belongsTo("App\Fase","idFase","idFase")->withTrashed();
    }

    public function relacao(){
        return $this->hasMany("App\RelFornResp","idResponsabilidade","idResponsabilidade");
    }

    public function pagoResponsabilidade(){
        return $this->belongsTo("App\PagoResponsabilidade","idResponsabilidade","idResponsabilidade");
    }
}
