<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutoStock extends Model
{
    use SoftDeletes;
    protected $table = 'ProdutoStock';

    protected $primaryKey = 'idProdutoStock';

    protected $fillable = [
        'descricao','tipoProduto','anoAcademico'
        ];

    public function faseStock(){
        return $this->hasMany("App\FaseStock","idProdutoStock","idProdutoStock");
    }
}
