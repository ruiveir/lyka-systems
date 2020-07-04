<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProdutoStock;
use Faker\Generator as Faker;

$factory->define(ProdutoStock::class, function (Faker $faker) {
    $idProdutoStock = 1;
    $ProdutoStocks = ProdutoStock::all();
    if($ProdutoStocks->toArray()){
        $idProdutoStock = ProdutoStock::all()->random()->id;
    }
    return [
        'idProdutoStock' => $idProdutoStock,
        'descricao' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'tipoProduto' => $faker->randomElement($array = array ('Licenciatura','Mestrado','Curso de Verão')),
        'anoAcademico' => '2020/21',
    ];
});
