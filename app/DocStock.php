<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocStock extends Model
{
    
    protected $table = 'DocStock';
    protected $primaryKey = 'idDocStock';

    protected $fillable = [
        'tipo','tipoDocumento','$idFaseStock'
        ];

    public function faseStock(){
        return $this->belongsTo("App\FaseStock","idFaseStock","idFaseStock");
    }
}
