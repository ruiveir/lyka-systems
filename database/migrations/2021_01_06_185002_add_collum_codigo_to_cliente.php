<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollumCodigoToCliente extends Migration
{
    public function up()
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->string('codigo',10)->nullable()->unique();
        });
    }

    public function down()
    {
        Schema::table('cliente', function (Blueprint $table) {
            //
        });
    }
}
