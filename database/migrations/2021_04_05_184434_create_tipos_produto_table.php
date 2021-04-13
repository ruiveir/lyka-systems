<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiposproduto', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->bigIncrements('tipoProduto_id');
            $table->string('designacao',255);
            $table->string('slug')->nullable();

            $table->timestamps();
        });

        $data = array(
            array('designacao'=>'Licenciatura','slug' => 'licenciatura'),
            array('designacao'=>'Mestrado','slug' => 'mestrado'),
            array('designacao'=>'Doutoramento','slug' => 'doutoramento'),
            array('designacao'=>'Curso de Verão','slug' => 'curso-de-verao'),
            array('designacao'=>'Estágio Profissional','slug' => 'estagio-profissional'),
            array('designacao'=>'Transferência de Curso','slug' => 'transferencia-de-curso'),
            array('designacao'=>'Curso Indiomas','slug' => 'curso-indiomas'),
            array('designacao'=>'Erasmus','slug' => 'erasmus'),
            array('designacao'=>'Pré-Universitário','slug' => 'pre-universitario'),
            array('designacao'=>'Serviços Estudar Portugal','slug' => 'servicos-estudar-portugal'),
            array('designacao'=>'Seguro','slug' => 'seguro'),
            array('designacao'=>'Exames','slug' => 'exames'),
            array('designacao'=>'Pré+Exame+Licenciatura','slug' => 'preexamelicenciatura'),
            array('designacao'=>'Pré+Licenciatura','slug' => 'prelicenciatura'),
            array('designacao'=>'Exame+Licenciatura','slug' => 'examelicenciatura'),
        );

        DB::table('tiposproduto')->insert($data);        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiposproduto');
    }
}
