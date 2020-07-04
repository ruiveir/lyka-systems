<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Universidade;
use Faker\Generator as Faker;

$factory->define(Universidade::class, function (Faker $faker) {
    $idUniversidade = 1;
    $Universidades = Universidade::all();
    if($Universidades->toArray()){
        $idUniversidade = Universidade::all()->random()->id;
    }
    return [
        'idUniversidade' => $idUniversidade,
        'nome' => $faker->company,
        'morada' => $faker->streetAddress.' '.$faker->streetName.', '.$faker->city,
        'telefone' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'email' => $faker->companyEmail,
        'NIF' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'IBAN' => $faker->iban('351'),
        'observacoes' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'obsCursos' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'obsCandidaturas' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'slug' => 'universidade',
    ];
});
