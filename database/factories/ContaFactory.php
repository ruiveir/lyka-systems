<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Conta;
use Faker\Generator as Faker;

$factory->define(Conta::class, function (Faker $faker) {
    $idConta = 1;
    $Contas = Conta::all();
    if($Contas->toArray()){
        $idConta = Conta::all()->random()->id;
    }
    return [
        'idConta' => $idConta,
        'descricao' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'instituicao' => $faker->company,
        'titular' => $faker->firstNameFemale.' '.$faker->lastName,
        'morada' => $faker->streetAddress.' '.$faker->streetName.', '.$faker->city,
        'numConta' => $faker->unique()->bankAccountNumber,
        'IBAN' => $faker->unique()->iban('351'),
        'SWIFT' => $faker->unique()->swiftBicNumber,
        'contacto' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'obsConta' => null,
        'slug' => 'conta',
    ];
});
