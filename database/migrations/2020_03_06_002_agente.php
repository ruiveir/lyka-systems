<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Agente extends Migration
{
    public function up()
    {
        Schema::create('agente', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idAgente');

            $table->unsignedBigInteger('idAgenteAssociado')->nullable();
                $table->foreign('idAgenteAssociado')->references('idAgente')->on('agente');

            $table->string('nome',255);
            $table->string('apelido',255);
            $table->enum('genero',['F','M']);
            $table->enum('tipo',['Agente', 'Subagente']);
            $table->boolean('exepcao')->default(false);
            $table->string('email',255)->unique();

            $table->date('dataNasc');
            $table->string('fotografia',255)->nullable();
            $table->string('morada',255);
            $table->string('pais',255);
            $table->string('NIF',255)->unique();


            $table->string('num_doc',255)->unique();
            $table->string('img_doc',255)->nullable();

            $table->string('telefone1',255);
            $table->string('telefone2',255)->nullable();

            $table->string('IBAN',255)->nullable();
            $table->longText('observacoes')->nullable();


            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agente');
    }
}
