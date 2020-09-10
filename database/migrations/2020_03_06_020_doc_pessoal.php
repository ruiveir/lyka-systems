<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocPessoal extends Migration
{
    public function up()
    {
        Schema::create('doc_pessoal', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idDocPessoal');
            $table->string('idCliente',255)->nullable();
            $table->string('tipo', 255);
            $table->string('imagem',255)->nullable();
            $table->longText('info')->nullable();
            $table->date('dataValidade')->nullable();
            $table->boolean('verificacao')->default(false);
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('idFase')->nullable();
                $table->foreign('idFase')->references('idFase')->on('fase');
        });
    }

    public function down()
    {
        Schema::dropIfExists('doc_pessoal');
    }
}
