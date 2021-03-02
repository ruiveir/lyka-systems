<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollums extends Migration
{
    public function up()
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->string('universidade1', 255)->after('nivEstudoAtual')->nullable();
            $table->string('universidade2', 255)->after('universidade1')->nullable();
            $table->string('curso1', 255)->after('universidade2')->nullable();
            $table->string('curso2', 255)->after('curso1')->nullable();
            $table->string('curso3', 255)->after('curso2')->nullable();
        });
    }

    public function down()
    {
        Schema::table('cliente', function (Blueprint $table) {
            //
        });
    }
}
