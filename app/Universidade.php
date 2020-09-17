<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Universidade extends Model
{
    use HasSlug, SoftDeletes;
    protected $table = 'universidade';
    protected $primaryKey = 'idUniversidade';

    protected $fillable = [
        'nome',
        'morada',
        'telefone',
        'email',
        'NIF',
        'IBAN',
        'observacoes',
        'obsCursos',
        'obsCandidaturas'
    ];

    public function user()
    {
        return $this->belongsTo("App\User", "idUser", "idUser")->withTrashed();
    }

    public function produto()
    {
        return $this->hasMany("App\Produto", "idUniversidade1", "idUniversidade")->withTrashed();
    }

    public function produto2()
    {
        return $this->hasMany("App\Produto", "idUniversidade2", "idUniversidade")->withTrashed();
    }

    public function responsabilidade()
    {
        return $this->hasMany("App\Responsabilidade", "idUniversidade1", "idUniversidade")->withTrashed();
    }

    public function responsabilidade2()
    {
        return $this->hasMany("App\Responsabilidade", "idUniversidade2", "idUniversidade")->withTrashed();
    }

    public function contacto()
    {
        return $this->hasMany("App\Contacto", "idUniversidade", "idUniversidade");
    }

    public function agenda()
    {
        return $this->hasMany("App\Agenda","idUniversidade","idUniversidade");
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nome')
            ->saveSlugsTo('slug');
        }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
