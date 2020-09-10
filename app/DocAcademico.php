<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class DocAcademico extends Model
{
    use HasSlug;
    protected $table = 'doc_academico';
    protected $primaryKey = 'idDocAcademico';

    protected $fillable = [
        'idCliente',
        'nome',
        'tipo',
        'imagem',
        'info',
        'verificacao',
        '$idFase'
    ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase","idFase")->withTrashed();
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
