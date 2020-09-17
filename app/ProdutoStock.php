<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class ProdutoStock extends Model
{
    use HasSlug;
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

    public function getSlugOptions() : SlugOptions
    {
      return SlugOptions::create()
          ->generateSlugsFrom('descricao')
          ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
