<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DocAcademico;
use Faker\Generator as Faker;

$factory->define(DocAcademico::class, function (Faker $faker) {
    $idDocAcademico = 1;
    $DocAcademicos = DocAcademico::all();
    if($DocAcademicos->toArray()){
        $idDocAcademico = DocAcademico::all()->random()->id;
    }
    return [
        'idDocAcademico' => $idDocAcademico,
        'nome' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'tipo' => $faker->randomElement($array = array ('Certificado','Diploma')),
        'imagem' => 'default-photos/university.png',
        'info' => '{"valor":"'.$faker->sentence($nbWords = 3, $variableNbWords = true).'"}',
        'verificacao' => false,

        'slug' => 'docacademico',

        
        'idCliente' => factory(App\Cliente::class),
        'idFase' => factory(App\Fase::class),
    ];
});
