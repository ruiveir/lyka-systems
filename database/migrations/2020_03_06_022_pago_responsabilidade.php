<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PagoResponsabilidade extends Migration
{
    public function up()
    {
        Schema::create('PagoResponsabilidade', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idPagoResp');
            $table->string('beneficiario',255);
            $table->decimal('valorPago', 18, 2);
            $table->string('descricao', 150);
            $table->text('observacoes')->nullable();
            $table->date('dataPagamento');
            $table->string('comprovativoPagamento',255)->nullable();
            $table->unsignedBigInteger('idResponsabilidade');
                $table->foreign('idResponsabilidade')->references('idResponsabilidade')->on('Responsabilidade');
            $table->unsignedBigInteger('idConta');
                $table->foreign('idConta')->references('idConta')->on('Conta');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('PagoResponsabilidade');
    }
}
