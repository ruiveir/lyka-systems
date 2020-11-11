<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelatorioProblema extends Migration
{
    public function up()
    {
        Schema::create('relatorio_problema', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('idRelatorioProblema');
            $table->string('nome');
            $table->string('email');
            $table->integer('telemovel')->nullable();
            $table->string('screenshot')->nullable();
            $table->text('relatorio');
            $table->enum('estado', ['Pendente', 'Em curso', 'Resolvido'])->default('Pendente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('relatorio_problema');
    }
}
