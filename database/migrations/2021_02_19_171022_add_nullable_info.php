<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableInfo extends Migration
{
    public function up()
    {
        Schema::table('doc_academico', function (Blueprint $table) {
            $table->longText('info')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('doc_academico', function (Blueprint $table) {
            //
        });
    }
}
