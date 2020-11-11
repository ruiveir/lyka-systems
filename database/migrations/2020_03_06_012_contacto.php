<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contacto extends Migration
{
    public function up()
    {
        Schema::create('contacto', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('idContacto');

            $table->unsignedBigInteger('idUser')->nullable();
                $table->foreign('idUser')->references('idUser')->on('user');
            $table->unsignedBigInteger('idUniversidade')->nullable();
                $table->foreign('idUniversidade')->references('idUniversidade')->on('universidade');

            $table->string('nome',255);
            $table->string('fotografia',255)->nullable();
            $table->string('telefone1',255)->nullable();
            $table->string('telefone2',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('fax',255)->nullable();
            $table->longText('observacao')->nullable();
            $table->boolean('favorito')->default(false);
            $table->boolean('visibilidade')->default(false);

            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacto');
    }
}
