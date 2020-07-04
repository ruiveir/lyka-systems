<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fase;
use Faker\Generator as Faker;

$factory->define(Fase::class, function (Faker $faker) {
    $idFase = 1;
    $Fases = Fase::all();
    if($Fases->toArray()){
        $idFase = Fase::all()->random()->id;
    }
    return [
        'idFase' => $idFase,
        'descricao' => $faker->randomElement($array = array ('Inscricao','Matricula', 'Final')),
        'dataVencimento' => $faker->date($format = 'Y-m-d', $max = '+5 days'),
        'valorFase' => $faker->numberBetween($min = 100, $max = 1000),
        'verificacaoPago' => false,
        'icon' => 'default-photos/university.png',
        'estado' => $faker->randomElement($array = array ('Pendente','Pago', 'Dívida', 'Crédito')),

        'slug' => 'fase',


        'idProduto' => factory(App\Produto::class),
    ];
});
