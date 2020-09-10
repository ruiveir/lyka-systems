<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProdutoStock extends Migration
{
    public function up()
    {
        Schema::create('produto_stock', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idProdutoStock');
            $table->string('descricao',255);
            $table->enum('tipoProduto',['Licenciatura','Mestrado','Doutoramento','Curso de Verão','Estágio Profissional','Transferência de Curso','Curso Indiomas','Erasmus','Pré-Universitário']);
            $table->string('anoAcademico',255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produto_stock');
    }
}
