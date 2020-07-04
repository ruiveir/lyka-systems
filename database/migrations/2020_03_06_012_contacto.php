<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contacto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Contacto', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idContacto');
            $table->unsignedBigInteger('idUser')->nullable();
                $table->foreign('idUser')->references('idUser')->on('User');

            $table->unsignedBigInteger('idUniversidade')->nullable();
                $table->foreign('idUniversidade')->references('idUniversidade')->on('Universidade');

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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Contacto');
    }
}

