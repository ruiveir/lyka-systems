<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnumToTipoProduto extends Migration
{
    public function up()
    {
        Schema::table('produto_stock', function (Blueprint $table) {
            DB::statement("ALTER TABLE produto_stock MODIFY COLUMN tipoProduto ENUM('Licenciatura','Mestrado','Doutoramento','Curso de Verão','Estágio Profissional','Transferência de Curso','Curso Indiomas','Erasmus','Pré-Universitário','Seguro','Serviços Estudar Portugal','Exames','Pré+Exame+Licenciatura','Pré+Licenciatura','Exame+Licenciatura') NOT NULL");
        });
    }

    public function down()
    {
        Schema::table('produto_stock', function (Blueprint $table) {
            //
        });
    }
}
