<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class ClienteObservacoes extends Model
{
    use HasSlug;
    protected $table = 'cliente_observacoes';
    protected $primaryKey = 'idObservacao';

    protected $fillable = [
        'titulo',
        'texto'
    ];

    public function cliente()
    {
        return $this->belongsTo("App\Cliente", "idCliente", "idCliente")->withTrashed();
    }

    public function getSlugOptions() : SlugOptions
    {
      return SlugOptions::create()
          ->generateSlugsFrom('titulo')
          ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
