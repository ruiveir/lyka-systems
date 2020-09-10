<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class DocTransacao extends Model
{
    use HasSlug;
    protected $table = 'doc_transacao';
    protected $primaryKey = 'idDocTransacao';

    protected $fillable = [
        'descricao',
        'valorRecebido',
        'dataOperacao',
        'dataRecebido',
        'observacoes',
        'tipoPagamento',
        'comprovativoPagamento',
        '$idConta',
        '$idFase'
    ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase","idFase")->withTrashed();
    }

    public function conta(){
        return $this->belongsTo("App\Conta","idConta","idConta")->withTrashed();
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
