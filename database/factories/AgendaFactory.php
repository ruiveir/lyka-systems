<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agenda;
use Faker\Generator as Faker;

$factory->define(Agenda::class, function (Faker $faker) {
    $idAgenda = 1;
    $Agendas = Agenda::all();
    if($Agendas->toArray()){
        $idAgenda = Agenda::all()->random()->id;
    }
    return [
        'idAgenda' => $idAgenda,
        'titulo' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'descricao' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'visibilidade' => 0,
        'dataInicio' => $faker->date($format = 'Y-m-d H:i', $max = 'now'),
        'dataFim' => $faker->date($format = 'Y-m-d H:i', $max = '+2 days'),
        'cor' => $faker->hexcolor,

        
        'idUser' => factory(App\User::class),
        'idUniversidade' => factory(App\Universidade::class),
    ];
});
