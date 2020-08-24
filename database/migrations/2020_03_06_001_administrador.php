<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Administrador extends Migration
{
    public function up()
    {
        Schema::create('Administrador', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idAdmin');
            $table->string('nome',255);
            $table->string('apelido',255);
            $table->enum('genero',['F','M']);
            $table->string('email',255)->unique();
            $table->date('dataNasc');
            $table->string('fotografia',255)->nullable();
            $table->integer('telefone1');
            $table->integer('telefone2')->nullable();
            $table->boolean('superAdmin')->default(false);
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        $data = array(
            array('idAdmin'=>'1', 'nome'=>'Senhor', 'apelido'=>'Administrador', 'genero' => 'M','email' => 'admin@test.com', 'dataNasc'=>'2000-01-01', 'telefone1'=>'912345678', 'superAdmin' => true, 'slug' => 'senhor-administrador', 'created_at'=>'2020-02-12 00:00:00', 'updated_at'=>'2020-02-12 00:00:00'),
        );

        DB::table('Administrador')->insert($data);
    }

    public function down()
    {
        Schema::dropIfExists('Administrador');
    }
}
