<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Universidade extends Migration
{
    public function up()
    {
        Schema::create('universidade', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('idUniversidade');
            $table->string('nome',255);
            $table->string('morada',255)->nullable();
            $table->string('telefone',255)->nullable();
            $table->string('email',255);
            $table->string('NIF',255)->unique();
            $table->string('IBAN',255)->nullable();
            $table->longText('observacoes')->nullable();
            $table->longText('obsCursos')->nullable();
            $table->longText('obsCandidaturas')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('universidade');
    }
}
