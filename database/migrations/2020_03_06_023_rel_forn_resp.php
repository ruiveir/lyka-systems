<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelFornResp extends Migration
{
    public function up()
    {
        Schema::create('RelFornResp', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idRelacao');
            $table->decimal('valor', 18, 2);
            $table->boolean('verificacaoPago')->default(false);
            $table->enum('estado', ['Pendente', 'Pago', 'Dívida'])->default('Pendente');
            $table->dateTime('dataVencimento')->nullable();
            $table->unsignedBigInteger('idResponsabilidade');
                $table->foreign('idResponsabilidade')->references('idResponsabilidade')->on('Responsabilidade');
            $table->unsignedBigInteger('idFornecedor');
                $table->foreign('idFornecedor')->references('idFornecedor')->on('Fornecedor');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('RelFornResp');
    }
}
