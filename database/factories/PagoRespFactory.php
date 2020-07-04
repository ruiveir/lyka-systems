<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PagoResponsabilidade;
use Faker\Generator as Faker;

$factory->define(PagoResponsabilidade::class, function (Faker $faker) {
    $idPagoResp = 1;
    $PagoResponsabilidades = PagoResponsabilidade::all();
    if($PagoResponsabilidades->toArray()){
        $idPagoResp = PagoResponsabilidade::all()->random()->id;
    }
    return [
        'idPagoResp' => $idPagoResp,
        'beneficiario' => $faker->randomElement($array = array ('Agente','Cliente','Universidade')),
        'valorPago' => $faker->numberBetween($min = 10, $max = 1000),
        'comprovativoPagamento' => 'default-photos/university.png',
        'dataPagamento' => $faker->date($format = 'Y-m-d', $max = 'now'),


        'idResponsabilidade' => factory(App\Responsabilidade::class),
        'idConta' => factory(App\Conta::class),
    ];
});
