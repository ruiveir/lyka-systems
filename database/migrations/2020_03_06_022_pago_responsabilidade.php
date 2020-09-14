<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PagoResponsabilidade extends Migration
{
    public function up()
    {
        Schema::create('pago_responsabilidade', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idPagoResp');
            $table->string('beneficiario',255);
            $table->enum('tipo_beneficiario', ['Cliente', 'Agente', 'Subagente', 'UniPrincipal', 'UniSecundaria', 'Fornecedor']);
            $table->decimal('valorPago', 18, 2);
            $table->string('descricao', 150);
            $table->text('observacoes')->nullable();
            $table->date('dataPagamento');
            $table->string('comprovativoPagamento',255)->nullable();
            $table->unsignedBigInteger('idResponsabilidade');
                $table->foreign('idResponsabilidade')->references('idResponsabilidade')->on('responsabilidade');
            $table->unsignedBigInteger('idConta');
                $table->foreign('idConta')->references('idConta')->on('conta');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pago_responsabilidade');
    }
}
