<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Responsabilidade;
use Faker\Generator as Faker;

$factory->define(Responsabilidade::class, function (Faker $faker) {
    $idResponsabilidade = 1;
    $Responsabilidades = Responsabilidade::all();
    if($Responsabilidades->toArray()){
        $idResponsabilidade = Responsabilidade::all()->random()->id;
    }
    return [
        'idResponsabilidade' => $idResponsabilidade,
        'valorCliente' => $faker->numberBetween($min = 100, $max = 500),
        'valorAgente' => $faker->numberBetween($min = 100, $max = 500),
        'valorSubAgente' => null,
        'valorUniversidade1' => $faker->numberBetween($min = 100, $max = 500),
        'valorUniversidade2' => null,
        'dataVencimentoCliente' => $faker->date($format = 'Y-m-d', $max = '+1 month'),
        'dataVencimentoAgente' => $faker->date($format = 'Y-m-d', $max = '+1 month'),
        'dataVencimentoSubAgente' => null,
        'dataVencimentoUni1' => $faker->date($format = 'Y-m-d', $max = '+1 month'),
        'dataVencimentoUni2' => null,
        'verificacaoPagoCliente' => false,
        'verificacaoPagoAgente' => false,
        'verificacaoPagoSubAgente' => false,
        'verificacaoPagoUni1' => false,
        'verificacaoPagoUni2' => false,
        'estado' => $faker->randomElement($array = array ('Pendente','Pago', 'Dívida', 'Crédito')),


        'idFase' => factory(App\Fase::class),
        'idCliente' => factory(App\Cliente::class),
        'idAgente' => factory(App\Agente::class),
        'idSubAgente' => factory(App\Agente::class),
        'idUniversidade1' => factory(App\Universidade::class),
        'idUniversidade2' => factory(App\Universidade::class),
    ];
});
