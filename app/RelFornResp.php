<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelFornResp extends Model
{
    protected $table = 'rel_forn_resp';
    protected $primaryKey = 'idRelacao';

    protected $fillable = [
        'valor',
        'verificacaoPago',
        'estado',
        'dataVencimento',
        '$idResponsabilidade',
        '$idFornecedor',
        '$idConta'
    ];

    protected $dates = [
        'dataVencimento'
    ];

    public function fornecedor(){
        return $this->belongsTo("App\Fornecedor","idFornecedor","idFornecedor")->withTrashed();
    }

    public function responsabilidade(){
        return $this->belongsTo("App\Responsabilidade","idResponsabilidade","idResponsabilidade")->withTrashed();
    }

    public function conta(){
        return $this->belongsTo("App\Conta","idConta","idConta")->withTrashed();
    }
}
