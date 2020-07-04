<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    $gender = $faker->randomElement($array = array('F','M'));
    $nome=null;
    if($gender == "F"){
        $nome = $faker->firstNameFemale;
    }else{
        $nome = $faker->firstNameMale;
    }
    $apelido = $faker->lastName;
    $idCliente = 1;
    $Clientes = Cliente::all();
    if($Clientes->toArray()){
        $idCliente = Cliente::all()->random()->id;
    }
    return [
        'idCliente' => $idCliente,
        'nome' => $nome,
        'apelido' => $apelido,
        'genero' => $gender,
        'email' => $faker->unique()->freeEmail,
        'telefone1' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'telefone2' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'dataNasc' => $faker->date($format = 'Y-m-d', $max = '-20 years'),
        'paisNaturalidade' => $faker->country,
        'morada' => $faker->streetAddress.' '.$faker->streetName,
        'cidade' => $faker->city,
        'moradaResidencia' => $faker->streetAddress.' '.$faker->streetName.', '.$faker->city,
        'nomePai' => $faker->firstNameMale.' '.$apelido,
        'telefonePai' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'emailPai' => $faker->freeEmail,
        'nomeMae' => $faker->firstNameFemale.' '.$apelido,
        'telefoneMae' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'emailMae' => $faker->freeEmail,
        'fotografia' => null,
        'NIF' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'IBAN' => $faker->iban('351'),
        'nivEstudoAtual' => null,
        'nomeInstituicaoOrigem' => $faker->company,
        'cidadeInstituicaoOrigem' => $faker->city,
        'num_docOficial' => $faker->unique()->phoneNumber,
        'validade_docOficial' => $faker->date($format = 'Y-m-d', $max = '+5 years'),
        'numPassaporte' => $faker->phoneNumber,
        'obsPessoais' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'obsFinanceiras' => null,
        'obsAcademicas' => null,
        'estado' => 'Ativo',
        'editavel' => 1,

        'slug' => $nome,

        
        'idAgente' => factory(App\Agente::class),
    ];
});
