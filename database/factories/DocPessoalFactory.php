<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DocPessoal;
use Faker\Generator as Faker;

$factory->define(DocPessoal::class, function (Faker $faker) {
    $idDocPessoal = 1;
    $DocPessoals = DocPessoal::all();
    if($DocPessoals->toArray()){
        $idDocPessoal = DocPessoal::all()->random()->id;
    }
    return [
        'idDocPessoal' => $idDocPessoal,
        'tipo' => $faker->randomElement($array = array ('Doc. Pessoal','Passaport')),
        'imagem' => 'default-photos/university.png',
        'info' => '{"valor":"'.$faker->sentence($nbWords = 3, $variableNbWords = true).'"}',
        'dataValidade' => $faker->date($format = 'Y-m-d', $max = '+5 years'),
        'verificacao' => false,

        'slug' => 'docpessoal',

        
        'idCliente' => factory(App\Cliente::class),
        'idFase' => factory(App\Fase::class),
    ];
});
