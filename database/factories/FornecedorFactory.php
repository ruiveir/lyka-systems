<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fornecedor;
use Faker\Generator as Faker;

$factory->define(Fornecedor::class, function (Faker $faker) {
    $idFornecedor = 1;
    $Fornecedores = Fornecedor::all();
    if($Fornecedores->toArray()){
        $idFornecedor = Fornecedor::all()->random()->id;
    }
    return [
        'idFornecedor' => $idFornecedor,
        'nome' => $faker->firstNameFemale.' '.$faker->lastName,
        'morada' => $faker->streetAddress.' '.$faker->streetName.', '.$faker->city,
        'contacto' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'descricao' => $faker->sentence($nbWords = 7, $variableNbWords = true),
        'observacoes' => null,
        'slug' => 'fornecedor',
    ];
});
