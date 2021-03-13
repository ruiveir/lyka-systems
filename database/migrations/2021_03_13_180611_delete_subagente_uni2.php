<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteSubagenteUni2 extends Migration
{
    public function up()
    {
        Schema::table('responsabilidade', function (Blueprint $table) {
            $table->dropForeign('responsabilidade_idsubagente_foreign');
            $table->dropForeign('responsabilidade_iduniversidade2_foreign');
            $table->dropColumn(['valorSubAgente', 'valorUniversidade2', 'dataVencimentoSubAgente', 'dataVencimentoUni2', 'verificacaoPagoSubAgente', 'verificacaoPagoUni2', 'idSubAgente', 'idUniversidade2']);
        });
    }

    public function down()
    {
        Schema::table('responsabilidade', function (Blueprint $table) {
            //
        });
    }
}
