<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DocStock', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idDocStock');
            $table->enum('tipo',['Pessoal', 'Academico']);
            $table->string('tipoDocumento', 255);
            $table->timestamps();
            $table->unsignedBigInteger('idFaseStock');
                $table->foreign('idFaseStock')->references('idFaseStock')->on('FaseStock');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DocStock');
    }
}
