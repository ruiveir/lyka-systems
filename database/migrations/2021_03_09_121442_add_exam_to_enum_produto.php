<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExamToEnumProduto extends Migration
{
    public function up()
    {
        Schema::table('produto', function (Blueprint $table) {
            DB::statement("ALTER TABLE produto MODIFY COLUMN tipo ENUM('Licenciatura','Mestrado','Doutoramento','Curso de Verão','Estágio Profissional','Transferência de Curso','Curso Indiomas','Erasmus','Pré-Universitário','Seguro','Serviços Estudar Portugal','Exames') NOT NULL");
        });
    }

    public function down()
    {
        Schema::table('produto', function (Blueprint $table) {
            //
        });
    }
}
