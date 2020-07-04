<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Agenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Agenda', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idAgenda');

            $table->unsignedBigInteger('idUser');
                $table->foreign('idUser')->references('idUser')->on('User');

            $table->unsignedBigInteger('idUniversidade')->nullable();
                $table->foreign('idUniversidade')->references('idUniversidade')->on('Universidade');

            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->boolean('visibilidade')->default(false);
            $table->dateTime('dataInicio');
            $table->dateTime('dataFim');
            $table->string('cor', 7);
            $table->timestamps();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Agenda');
    }
}
