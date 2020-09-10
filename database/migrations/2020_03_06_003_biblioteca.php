<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Biblioteca extends Migration
{
    public function up()
    {
        Schema::create('biblioteca', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idBiblioteca');
            $table->enum('acesso',['Privado', 'Público'])->default('Privado');
            $table->string('descricao',255);
            $table->string('ficheiro',255);
            $table->string('tipo',255);
            $table->string('tamanho',255);
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('biblioteca');
    }
}
