<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocStock extends Migration
{
    public function up()
    {
        Schema::create('doc_stock', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('idDocStock');
            $table->enum('tipo',['Pessoal', 'Academico']);
            $table->string('tipoDocumento', 255);
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('idFaseStock');
                $table->foreign('idFaseStock')->references('idFaseStock')->on('fase_stock');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doc_stock');
    }
}
