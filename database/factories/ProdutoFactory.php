<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produto;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    $idProduto = 1;
    $Produtos = Produto::all();
    if($Produtos->toArray()){
        $idProduto = Produto::all()->random()->id;
    }
    return [
        'idProduto' => $idProduto,
        'descricao' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'tipo' => $faker->randomElement($array = array ('Licenciatura','Mestrado','Curso de Verão')),
        'anoAcademico' => '2020/21',
        'valorTotal' => $faker->numberBetween($min = 500, $max = 5000),
        'valorTotalAgente' => $faker->numberBetween($min = 100, $max = 500),
        'valorTotalSubAgente' => $faker->numberBetween($min = 100, $max = 500),
        'estado' => $faker->randomElement($array = array ('Pendente','Pago', 'Dívida', 'Crédito')),

        'slug' => 'produto',


        'idCliente' => factory(App\Cliente::class),
        'idAgente' => factory(App\Agente::class),
        'idUniversidade1' => factory(App\Universidade::class),
        'idUniversidade2' => factory(App\Universidade::class),
        /*  idSubAgente  */
    ];
});
