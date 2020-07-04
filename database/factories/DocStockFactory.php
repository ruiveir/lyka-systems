<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DocStock;
use Faker\Generator as Faker;

$factory->define(DocStock::class, function (Faker $faker) {
    $idDocStock = 1;
    $DocStocks = DocStock::all();
    if($DocStocks->toArray()){
        $idDocStock = DocStock::all()->random()->id;
    }
    return [
        'idDocStock' => $idDocStock,
        'tipo' => $faker->randomElement($array = array ('Pessoal','Academico')),
        'tipoDocumento' => $faker->randomElement($array = array ('Diploma','Doc. Oficial')),


        'idFaseStock' => factory(App\FaseStock::class),
    ];
});
