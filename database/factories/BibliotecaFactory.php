<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Biblioteca;
use Faker\Generator as Faker;

$factory->define(Biblioteca::class, function (Faker $faker) {
    $idBiblioteca = 1;
    $Bibliotecas = Biblioteca::all();
    if($Bibliotecas->toArray()){
        $idBiblioteca = Biblioteca::all()->random()->id;
    }
    return [
        'idBiblioteca' => $idBiblioteca,
        'acesso' => 'Privado',
        'descricao' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'ficheiro' => 'default-photos/university.png',
        'tipo' => 'png',
        'tamanho' => '246 KB',
        'slug' => 'biblioteca',
    ];
});
