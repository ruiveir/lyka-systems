<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RelFornResp;
use Faker\Generator as Faker;

$factory->define(RelFornResp::class, function (Faker $faker) {
    $idRelFornResp = 1;
    $RelFornResps = RelFornResp::all();
    if($RelFornResps->toArray()){
        $idRelFornResp = RelFornResp::all()->random()->id;
    }
    return [
        'idRelacao' => $idRelFornResp,
        'valor' => $faker->numberBetween($min = 10, $max = 100),
        'verificacaoPago' => false,
        'dataVencimento' => $faker->date($format = 'Y-m-d', $max = '+1 month'),
        'estado' => $faker->randomElement($array = array ('Pendente','Pago', 'Dívida', 'Crédito')),


        'idResponsabilidade' => factory(App\Responsabilidade::class),
        'idFornecedor' => factory(App\Fornecedor::class),
    ];
});
