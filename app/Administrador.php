<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{

    protected $table = 'Administrador';

    protected $primaryKey = 'idAdmin';

    protected $fillable = [
        'nome',
        'apelido',
        'genero',
        'email',
        'dataNasc',
        'fotografia',
        'telefone1',
        'telefone2',
        'superAdmin'
    ];

    public function user()
    {
        return $this->belongsTo("App\User","idAdmin","idAdmin");
    }
}
