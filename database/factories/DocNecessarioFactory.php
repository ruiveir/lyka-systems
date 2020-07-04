<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DocNecessario;
use Faker\Generator as Faker;

$factory->define(DocNecessario::class, function (Faker $faker) {
    $idDocNecessario = 1;
    $DocNecessarios = DocNecessario::all();
    if($DocNecessarios->toArray()){
        $idDocNecessario = DocNecessario::all()->random()->id;
    }
    return [
        'idDocNecessario' => $idDocNecessario,
        'tipo' => $faker->randomElement($array = array ('Pessoal','Academico')),
        'tipoDocumento' => $faker->randomElement($array = array ('Diploma','Doc. Oficial')),

        
        'idFase' => factory(App\Fase::class),
    ];
});
