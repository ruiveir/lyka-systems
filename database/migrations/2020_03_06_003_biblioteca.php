<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Biblioteca extends Migration
{
    public function up()
    {
        Schema::create('biblioteca', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('idBiblioteca');
            $table->enum('acesso',['Privado', 'Público'])->default('Privado');
            $table->string('descricao',255);
            $table->text('link')->nullable();
            $table->string('ficheiro',255)->nullable();
            $table->string('tipo',255)->nullable();
            $table->string('tamanho',255)->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('biblioteca');
    }
}
