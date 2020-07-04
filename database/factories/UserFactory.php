<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $idUser = 1;
    $Users = User::all();
    if($Users->toArray()){
        $idUser = User::all()->random()->id;
    }
    return [
        'idUser' => $idUser,
        'password' => Hash::make('teste1234'),
        'auth_key' => strtoupper(random_str(5)),
        'loginCount' => 0,
        'login_key' => null,
        'estado' => true,
        'slug' => 'user',
        'tipo' => 'admin',
        'idAdmin' => factory(App\Administrador::class),
        'email' => function (array $post) {return App\Administrador::find($post['idAdmin'])->email;},


        /*  'email'  'tipo'  'idAdmin'  'idAgente'  'idCliente'  */
    ];
});
