<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocNecessario extends Model
{
    use SoftDeletes;
    protected $table = 'DocNecessario';

    protected $primaryKey = 'idDocNecessario';

    protected $fillable = [
        'tipo','tipoPessoal','tipoAcademico','$idFase'
        ];

    public function fase(){
        return $this->belongsTo("App\Fase","idFase","idFase")->withTrashed();
    }
}
