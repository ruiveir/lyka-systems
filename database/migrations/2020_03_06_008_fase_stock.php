<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FaseStock extends Migration
{
    public function up()
    {
        Schema::create('fase_stock', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('idFaseStock');
            $table->string('descricao',255);
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('idProdutoStock');
                $table->foreign('idProdutoStock')->references('idProdutoStock')->on('produto_stock');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fase_stock');
    }
}
