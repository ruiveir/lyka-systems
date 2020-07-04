<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contacto;
use Faker\Generator as Faker;

$factory->define(Contacto::class, function (Faker $faker) {
    $idContacto = 1;
    $Contactos = Contacto::all();
    if($Contactos->toArray()){
        $idContacto = Contacto::all()->random()->id;
    }
    return [
        'idContacto' => $idContacto,
        'nome' => $faker->firstNameFemale,
        'fotografia' => null,
        'telefone1' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'telefone2' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'email' => $faker->freeEmail,
        'fax' => null,
        'observacao' => null,
        'favorito' => false,
        'visibilidade' => true,

        'slug' => 'contacto',

        
        'idUser' => factory(App\User::class),
        'idUniversidade' => factory(App\Universidade::class),
    ];
});
