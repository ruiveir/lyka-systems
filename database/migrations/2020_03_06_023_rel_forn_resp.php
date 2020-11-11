<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelFornResp extends Migration
{
    public function up()
    {
        Schema::create('rel_forn_resp', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('idRelacao');
            $table->decimal('valor', 18, 2);
            $table->boolean('verificacaoPago')->default(false);
            $table->enum('estado', ['Pendente', 'Pago', 'Dívida'])->default('Pendente');
            $table->dateTime('dataVencimento')->nullable();
            $table->unsignedBigInteger('idResponsabilidade');
                $table->foreign('idResponsabilidade')->references('idResponsabilidade')->on('responsabilidade');
            $table->unsignedBigInteger('idFornecedor');
                $table->foreign('idFornecedor')->references('idFornecedor')->on('fornecedor');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rel_forn_resp');
    }
}
