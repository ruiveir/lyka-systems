<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class DocPessoal extends Model
{
    use HasSlug;
    protected $table = 'doc_pessoal';
    protected $primaryKey = 'idDocPessoal';

    protected $fillable = [
        'idCliente',
        'tipo',
        'imagem',
        'info',
        'dataValidade',
        'verificacao',
        '$idFase'
    ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase","idFase")->withTrashed();
    }
    public function cliente(){
        return $this->belongsTo("App\Cliente","idCliente","idCliente")->withTrashed();
    }

    public function getSlugOptions() : SlugOptions
    {
      return SlugOptions::create()
          ->generateSlugsFrom('tipo')
          ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
