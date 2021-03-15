<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBoolExame extends Migration
{
    public function up()
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->boolean('exame')->after('nivEstudoAtual')->nullable();
        });
    }

    public function down()
    {
        Schema::table('cliente', function (Blueprint $table) {
            //
        });
    }
}
