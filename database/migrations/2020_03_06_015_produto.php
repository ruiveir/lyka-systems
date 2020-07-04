<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Produto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Produto', function (Blueprint $table) {
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
                $table->foreign('idAgente')->references('idAgente')->on('Agente');

            $table->unsignedBigInteger('idSubAgente')->nullable();
                $table->foreign('idSubAgente')->references('idAgente')->on('Agente');

            $table->unsignedBigInteger('idCliente');
                $table->foreign('idCliente')->references('idCliente')->on('Cliente');

            $table->unsignedBigInteger('idUniversidade1');
                $table->foreign('idUniversidade1')->references('idUniversidade')->on('Universidade');

            $table->unsignedBigInteger('idUniversidade2')->nullable();
                $table->foreign('idUniversidade2')->references('idUniversidade')->on('Universidade');
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
        Schema::dropIfExists('Produto');
    }
}
