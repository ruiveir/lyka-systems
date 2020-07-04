<?php

namespace App;


use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Cliente extends Model
{
    use HasSlug;
    use SoftDeletes;

    protected $table = 'Cliente';

    protected $primaryKey = 'idCliente';

    protected $fillable = [
        'idAgente','nome','apelido','genero','email','telefone1','telefone2','dataNasc',
        'paisNaturalidade','morada','cidade','moradaResidencia','nomePai','telefonePai',
        'emailPai','nomeMae','telefoneMae','emailMae','fotografia','NIF','IBAN',
        'nivEstudoAtual','nomeInstituicaoOrigem','cidadeInstituicaoOrigem',
        'num_docOficial','validade_docOficial','numPassaporte','estado','editavel','obsPessoais','obsFinanceiras','obsAcademicas','obsAgente','refCliente'
        ];


    public function user(){
        return $this->belongsTo("App\User","idUser","idUser")->withTrashed();
    }

    public function produto(){
        return $this->hasMany("App\Produto","idCliente","idCliente")->withTrashed();
    }

    public function responsabilidade()
    {
        return $this->hasMany("App\Responsabilidade","idCliente","idCliente")->withTrashed();
    }

    public function produtoSaved(){
        return $this->hasMany("App\Produto","idCliente","idCliente");
    }


        /* URL */

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
