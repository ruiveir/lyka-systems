<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';

    protected $fillable = [
        'data'
    ];

    public function user(){
        return $this->belongsTo("App\User","notifiable_id","idUser");
    }
}
