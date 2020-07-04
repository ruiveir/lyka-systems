<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Universidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Universidade', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Universidade');
    }
}
