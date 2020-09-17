<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class DocStock extends Model
{
    use HasSlug;
    protected $table = 'doc_stock';
    protected $primaryKey = 'idDocStock';

    protected $fillable = [
        'tipo',
        'tipoDocumento',
        '$idFaseStock'
    ];

    public function faseStock(){
        return $this->belongsTo("App\FaseStock","idFaseStock","idFaseStock");
    }

    public function getSlugOptions() : SlugOptions
    {
      return SlugOptions::create()
          ->generateSlugsFrom('tipoDocumento')
          ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
