<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoResponsabilidade extends Model
{
    protected $table = 'pago_responsabilidade';
    protected $primaryKey = 'idPagoResp';

    protected $fillable = [
        'beneficiario',
        'valorPago',
        'descricao',
        'comprovativoPagamento',
        'observacoes',
        '$idResponsabilidade',
        '$idConta'
    ];

    protected $dates = [
        'dataPagamento'
    ];

    public function responsabilidade(){
        return $this->belongsTo("App\Responsabilidade","idResponsabilidade","idResponsabilidade")->withTrashed();
    }

    public function conta(){
        return $this->belongsTo("App\Conta","idConta","idConta")->withTrashed();
    }
}
