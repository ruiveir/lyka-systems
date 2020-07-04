<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Administrador;
use Faker\Generator as Faker;

$factory->define(Administrador::class, function (Faker $faker) {

    $gender = $faker->randomElement($array = array('F','M'));
    $nome=null;
    if($gender == "F"){
        $nome = $faker->firstNameFemale;
    }else{
        $nome = $faker->firstNameMale;
    }
    $idAdministrador = 1;
    $Administradors = Administrador::all();
    if($Administradors->toArray()){
        $idAdministrador = Administrador::all()->random()->id;
    }
    return [
        'idAdmin' => $idAdministrador,
        'nome' => $nome,
        'apelido' => $faker->lastName,
        'genero' => $gender,
        'email' => $faker->unique()->freeEmail,
        'dataNasc' => $faker->date($format = 'Y-m-d', '1997-30-5'),
        'fotografia' => null,
        'telefone1' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'telefone2' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'superAdmin' => 0,
    ];
});
