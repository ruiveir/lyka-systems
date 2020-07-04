<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    public function up()
    {
        Schema::create('User', function (Blueprint $table) {
            $table->charset = 'latin1';
            $table->collation = 'latin1_swedish_ci';
            $table->bigIncrements('idUser');
            $table->string('email', 255)->unique();
            $table->enum('tipo',['admin', 'agente', 'cliente']);
            $table->string('password',255)->nullable();
            $table->string('auth_key', 5)->nullable();
            $table->bigInteger('loginCount')->default(0);
            $table->string('login_key')->nullable();
            $table->boolean('estado')->default(false);
            $table->string('slug')->nullable();

            $table->unsignedBigInteger('idAdmin')->nullable();
                $table->foreign('idAdmin')->references('idAdmin')->on('Administrador');

            $table->unsignedBigInteger('idAgente')->nullable();
                $table->foreign('idAgente')->references('idAgente')->on('Agente');

            $table->unsignedBigInteger('idCliente')->nullable();
                $table->foreign('idCliente')->references('idCliente')->on('Cliente');

            $table->timestamps();
            $table->softDeletes();
        });

    $password = Hash::make('admin');

    $data = array(
        array('idUser'=>'1', 'email'=>'admin@test.com', 'password'=> $password, 'tipo'=>'admin', 'auth_key' => strtoupper(random_str(5)), 'estado' => true, 'slug' => 'senhor-administrador', 'idAdmin'=>'1', 'created_at'=>'2020-02-12 00:00:00', 'updated_at'=>'2020-02-12 00:00:00'),
    );

    DB::table('User')->insert($data);

  }
    public function down()
    {
        Schema::dropIfExists('User');
    }
}
