<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoStock extends Model
{
    protected $table = 'produto_stock';
    protected $primaryKey = 'idProdutoStock';

    protected $fillable = [
        'descricao',
        'tipoProduto',
        'anoAcademico'
    ];

    public function faseStock(){
        return $this->hasMany("App\FaseStock","idProdutoStock","idProdutoStock");
    }
}
