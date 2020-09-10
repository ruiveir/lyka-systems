<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DocTransacao extends Migration
{
    public function up()
    {
        Schema::create('doc_transacao', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idDocTransacao');
            $table->string('descricao',255);
            $table->decimal('valorRecebido', 18, 2)->default(0);
            $table->enum('tipoPagamento', ['Multibanco', 'Paypal', 'Outro']);
            $table->date('dataOperacao');
            $table->date('dataRecebido')->nullable();
            $table->text('observacoes')->nullable();
            $table->string('comprovativoPagamento',255)->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('idConta');
                $table->foreign('idConta')->references('idConta')->on('conta');
            $table->unsignedBigInteger('idFase');
                $table->foreign('idFase')->references('idFase')->on('fase');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doc_transacao');
    }
}
