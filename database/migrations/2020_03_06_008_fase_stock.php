<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FaseStock extends Migration
{
    public function up()
    {
        Schema::create('fase_stock', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idFaseStock');
            $table->string('descricao',255);
            $table->timestamps();
            $table->unsignedBigInteger('idProdutoStock');
                $table->foreign('idProdutoStock')->references('idProdutoStock')->on('produto_stock');

        });
    }

    public function down()
    {
        Schema::dropIfExists('fase_stock');
    }
}
