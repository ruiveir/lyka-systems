<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;


class contacto extends Model
{
    use HasSlug;

    protected $table = 'Contacto';

    protected $primaryKey = 'idContacto';

    protected $fillable = [
        'idUniversidade','nome','fotografia','telefone1','telefone2','email','fax','observacao',
        'favorito','visibilidade','idUser','idUniversidade'
    ];
    public function user(){
        return $this->belongsTo("App\User","idUser","idUser")->withTrashed();
    }
    public function universidade(){
        return $this->belongsTo("App\Universidade","idUniversidade","idUniversidade")->withTrashed();
    }



        /* URL */

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
