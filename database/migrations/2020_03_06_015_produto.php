<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Produto extends Migration
{
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idProduto');
            $table->string('descricao',255);
            $table->enum('tipo',['Licenciatura','Mestrado','Doutoramento','Curso de Verão','Estágio Profissional','Transferência de Curso','Curso Indiomas','Erasmus','Pré-Universitário']);
            $table->string('anoAcademico',255);
            $table->decimal('valorTotal', 18, 2);
            $table->decimal('valorTotalAgente', 18, 2);
            $table->decimal('valorTotalSubAgente', 18, 2)->nullable();
            $table->enum('estado', ['Pendente', 'Pago', 'Dívida', 'Crédito'])->default('Pendente');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('idAgente');
                $table->foreign('idAgente')->references('idAgente')->on('agente');

            $table->unsignedBigInteger('idSubAgente')->nullable();
                $table->foreign('idSubAgente')->references('idAgente')->on('agente');

            $table->unsignedBigInteger('idCliente');
                $table->foreign('idCliente')->references('idCliente')->on('cliente');

            $table->unsignedBigInteger('idUniversidade1');
                $table->foreign('idUniversidade1')->references('idUniversidade')->on('universidade');

            $table->unsignedBigInteger('idUniversidade2')->nullable();
                $table->foreign('idUniversidade2')->references('idUniversidade')->on('universidade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produto');
    }
}
