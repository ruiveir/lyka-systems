<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocAcademico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DocAcademico', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idDocAcademico');
            $table->string('idCliente',255)->nullable();
            $table->string('nome',255);
            $table->string('tipo', 255);
            $table->string('imagem',255);
            $table->longText('info');
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->boolean('verificacao')->default(false);
            $table->unsignedBigInteger('idFase');
                $table->foreign('idFase')->references('idFase')->on('Fase');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DocAcademico');
    }
}
