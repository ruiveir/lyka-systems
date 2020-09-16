<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Agenda extends Migration
{
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('agenda_id');
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim')->nullable();
            $table->string('cor', 7);
            $table->boolean('visibilidade')->default(false);
            $table->unsignedBigInteger('idUser');
                $table->foreign('idUser')->references('idUser')->on('user');
            $table->unsignedBigInteger('idUniversidade')->nullable();
                $table->foreign('idUniversidade')->references('idUniversidade')->on('universidade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agenda');
    }
}
