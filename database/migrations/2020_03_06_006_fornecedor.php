<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fornecedor extends Migration
{
    public function up()
    {
        Schema::create('Fornecedor', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idFornecedor');
            $table->string('nome',255);
            $table->string('morada',255);
            $table->string('contacto');
            $table->text('descricao');
            $table->text('observacoes')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Fornecedor');
    }
}
