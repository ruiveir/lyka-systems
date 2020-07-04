<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocStock extends Model
{
    use SoftDeletes;
    
    protected $table = 'DocStock';
    protected $primaryKey = 'idDocStock';

    protected $fillable = [
        'tipo','tipoDocumento','$idFaseStock'
        ];

    public function faseStock(){
        return $this->belongsTo("App\FaseStock","idFaseStock","idFaseStock");
    }
}
