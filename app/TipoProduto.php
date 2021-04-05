<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    protected $table = 'tiposProduto';

    protected $primaryKey = 'tipoProduto_id';

    protected $fillable = ['designacao','slug'];
}
