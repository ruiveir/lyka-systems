<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollumIdSubAgenteToCliente extends Migration
{
    public function up()
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->unsignedBigInteger('idSubAgente')->after('idAgente')->nullable();
        });
    }

    public function down()
    {
        Schema::table('cliente', function (Blueprint $table) {
            //
        });
    }
}
