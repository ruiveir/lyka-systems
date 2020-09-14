<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes, HasSlug;
    protected $table = 'produto';
    protected $primaryKey = 'idProduto';

    protected $fillable = [
        'descricao','tipo','anoAcademico','valorTotal','valorTotalAgente', 'estado',
        'valorTotalSubAgente','$idAgente','$idSubAgente','$idCliente',
        '$idUniversidade1','$idUniversidade2'
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
        return $this->hasMany("App\Fase","idProduto","idProduto")->withTrashed();
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
