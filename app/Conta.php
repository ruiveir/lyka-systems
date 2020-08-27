<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    use SoftDeletes, HasSlug;

    protected $table = 'Conta';

    protected $primaryKey = 'idConta';

    protected $fillable = [
        'descricao',
        'instituicao',
        'titular',
        'morada',
        'numConta',
        'IBAN',
        'SWIFT',
        'contacto',
        'obsConta'
    ];

    public function pagoResponsabilidade(){
        return $this->hasMany("App\PagoResponsabilidade","idPagoResp","idPagoResp")->withTrashed();
    }

    public function docTransacao(){
        return $this->hasMany("App\DocTransacao","idConta","idConta")->withTrashed();
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
