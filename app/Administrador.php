<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Model
{
    use SoftDeletes;

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
        return $this->belongsTo("App\User","idUser","idUser")->withTrashed();
    }
}
