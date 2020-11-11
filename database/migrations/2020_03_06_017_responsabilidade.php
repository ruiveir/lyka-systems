<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Responsabilidade extends Migration
{
    public function up()
    {
        Schema::create('responsabilidade', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('idResponsabilidade');

            $table->decimal('valorCliente', 18, 2)->nullable();
            $table->decimal('valorAgente', 18, 2)->nullable();
            $table->decimal('valorSubAgente', 18, 2)->nullable();
            $table->decimal('valorUniversidade1', 18, 2)->nullable();
            $table->decimal('valorUniversidade2', 18, 2)->nullable();

            $table->dateTime('dataVencimentoCliente')->nullable();
            $table->dateTime('dataVencimentoAgente')->nullable();
            $table->dateTime('dataVencimentoSubAgente')->nullable();
            $table->dateTime('dataVencimentoUni1')->nullable();
            $table->dateTime('dataVencimentoUni2')->nullable();

            $table->boolean('verificacaoPagoCliente')->default(false);
            $table->boolean('verificacaoPagoAgente')->default(false);
            $table->boolean('verificacaoPagoSubAgente')->default(false);
            $table->boolean('verificacaoPagoUni1')->default(false);
            $table->boolean('verificacaoPagoUni2')->default(false);

            $table->unsignedBigInteger('idCliente');
                $table->foreign('idCliente')->references('idCliente')->on('cliente');

            $table->unsignedBigInteger('idAgente');
                $table->foreign('idAgente')->references('idAgente')->on('agente');

            $table->unsignedBigInteger('idSubAgente')->nullable();
                $table->foreign('idSubAgente')->references('idAgente')->on('agente');

            $table->unsignedBigInteger('idUniversidade1');
                $table->foreign('idUniversidade1')->references('idUniversidade')->on('universidade');

            $table->unsignedBigInteger('idUniversidade2')->nullable();
                $table->foreign('idUniversidade2')->references('idUniversidade')->on('universidade');

            $table->unsignedBigInteger('idFase');
                $table->foreign('idFase')->references('idFase')->on('fase');

            $table->enum('estado', ['Pendente', 'Pago', 'Dívida'])->default('Pendente');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('responsabilidade');
    }
}
