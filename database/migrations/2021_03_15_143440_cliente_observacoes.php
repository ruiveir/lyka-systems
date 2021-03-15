<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClienteObservacoes extends Migration
{
    public function up()
    {
        Schema::create('cliente_observacoes', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('idObservacao');
            $table->unsignedBigInteger('idCliente');
                $table->foreign('idCliente')->references('idCliente')->on('cliente');
            $table->string('titulo', 255);
            $table->longText('texto');
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
}
