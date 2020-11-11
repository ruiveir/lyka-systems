<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocNecessario extends Migration
{
    public function up()
    {
        Schema::create('doc_necessario', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('idDocNecessario');
            $table->enum('tipo',['Pessoal', 'Academico']);
            $table->string('tipoDocumento', 255);
            $table->timestamps();
            $table->unsignedBigInteger('idFase');
                $table->foreign('idFase')->references('idFase')->on('fase');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doc_necessario');
    }
}
