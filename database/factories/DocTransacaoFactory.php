<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DocTransacao;
use Faker\Generator as Faker;

$factory->define(DocTransacao::class, function (Faker $faker) {
    $idDocTransacao = 1;
    $DocTransacaos = DocTransacao::all();
    if($DocTransacaos->toArray()){
        $idDocTransacao = DocTransacao::all()->random()->id;
    }
    return [
        'idDocTransacao' => $idDocTransacao,
        'descricao' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'valorRecebido' => 0,
        'tipoPagamento' => $faker->randomElement($array = array ('Transferencia Bancaria','Paypal')),
        'dataOperacao' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'dataRecebido' => null,
        'observacoes' => null,
        'comprovativoPagamento' => 'default-photos/university.png',
        'verificacao' => false,

        'slug' => 'doctransacao',


        'idConta' => factory(App\Conta::class),
        'idFase' => factory(App\Fase::class),
    ];
});
