<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Conta extends Migration
{
    public function up()
    {
        Schema::create('conta', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('idConta');
            $table->string('descricao',255);
            $table->string('instituicao',255);
            $table->string('titular',255);
            $table->string('morada',255)->nullable();
            $table->bigInteger('numConta')->unique();
            $table->string('IBAN',255)->unique();
            $table->string('SWIFT',255)->unique();
            $table->string('contacto');
            $table->longText('obsConta')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conta');
    }
}
