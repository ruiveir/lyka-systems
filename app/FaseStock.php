<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaseStock extends Model
{
    protected $table = 'fase_stock';
    protected $primaryKey = 'idFaseStock';

    protected $fillable = [
        'descricao',
        '$idProdutoStock'
    ];

    public function produtoStock(){
        return $this->belongsTo("App\ProdutoStock","idProdutoStock","idProdutoStock");
    }

    public function docStock(){
        return $this->hasMany("App\DocStock","idFaseStock","idFaseStock");
    }

    public function fase(){
        return $this->hasMany("App\Fase","idFaseStock","idFaseStock")->withTrashed();
    }
}
