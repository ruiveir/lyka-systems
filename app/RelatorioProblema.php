<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatorioProblema extends Model
{
  protected $table = 'RelatorioProblema';

  protected $primaryKey = 'idRelatorioProblema';

  protected $fillable = [
      'nome',
      'email',
      'telemovel',
      'screenshot',
      'relatorio',
      'estado'
  ];
}
