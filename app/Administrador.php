<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Model
{
    use SoftDeletes, HasSlug;

    protected $table = 'Administrador';

    protected $primaryKey = 'idAdmin';

    protected $fillable = [
        'nome',
        'apelido',
        'genero',
        'email',
        'dataNasc',
        'telefone1',
        'telefone2',
        'superAdmin'
    ];

    public function user()
    {
        return $this->belongsTo("App\User","idAdmin","idAdmin")->withTrashed();
    }

    public function getSlugOptions() : SlugOptions
    {
      return SlugOptions::create()
          ->generateSlugsFrom(['nome','apelido'])
          ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
