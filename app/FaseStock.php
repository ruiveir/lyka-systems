<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class FaseStock extends Model
{
    use HasSlug;
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
