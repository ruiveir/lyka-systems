<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agente extends Model
{
    use HasSlug, SoftDeletes;
    protected $table = 'agente';
    protected $primaryKey = 'idAgente';

    protected $fillable = [
        'idAgenteAssociado','nome','apelido','genero','tipo','exepcao','email','dataNasc',
        'fotografia','morada','pais','NIF','num_doc','img_doc','telefone1','telefone2','IBAN','observacoes','slug'
    ];

    public function user()
    {
        return $this->belongsTo("App\User","idAgente","idAgente");
    }

    public function produtoA(){
        return $this->hasMany("App\Produto","idAgente","idAgente")->withTrashed();
    }

    public function produtoSubA(){
        return $this->hasMany("App\Produto","idSubAgente","idAgente")->withTrashed();
    }

    public function responsabilidade()
    {
        return $this->hasMany("App\Responsabilidade","idAgente","idAgente")->withTrashed();
    }

    public function subAgente(){
        return $this->hasMany("App\Agente","idAgente","idAgenteAssociado")->withTrashed();
    }

    public function agente(){
        return $this->belongsTo("App\Agente","idAgenteAssociado","idAgente")->withTrashed();
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
