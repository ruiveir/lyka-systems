<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FaseStock;
use Faker\Generator as Faker;

$factory->define(FaseStock::class, function (Faker $faker) {
    $idFaseStock = 1;
    $FaseStocks = FaseStock::all();
    if($FaseStocks->toArray()){
        $idFaseStock = FaseStock::all()->random()->id;
    }
    return [
        'idFaseStock' => $idFaseStock,
        'descricao' => $faker->randomElement($array = array ('Inscricao','Matricula', 'Final')),


        'idProdutoStock' => factory(App\ProdutoStock::class),
    ];
});
