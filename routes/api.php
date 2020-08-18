<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('stock')->group(function(){

        Route::get('/produtos', 'StockController@produtos')->name('produtos');

        Route::get('/produto/{id}', 'StockController@produto')->name('produto');

        Route::get('produto/{id}/fases', 'StockController@fases')->name('fases');

        Route::get('fase/{id}/documentos', 'StockController@documentos')->name('documentos');

    });
    Route::get('listagem/{pesquisa}', 'ListagemController@getList')->name('getList');
    Route::get('listagem/cidades/{pais}', 'ListagemController@getCountries')->name('getCountries');
    
    Route::prefix('unique')->group(function(){

        Route::get('/agente/{P_Agente}/{uniques}', 'UniqueController@agente')->name('agente');

        Route::get('/cliente/{P_Cliente}/{uniques}', 'UniqueController@cliente')->name('prclienteoduto');

        Route::get('/admin/{P_Administrador}/{email}', 'UniqueController@administrador')->name('administrador');

        Route::get('/conta/{P_Conta}/{uniques}', 'UniqueController@conta')->name('conta');

        Route::get('/uni/{P_Universidade}/{NIF}', 'UniqueController@universidade')->name('universidade');

        Route::get('/agente/{uniques}', 'UniqueController@agente')->name('agente');

        Route::get('/cliente/{uniques}', 'UniqueController@cliente')->name('prclienteoduto');

        Route::get('/admin/{email}', 'UniqueController@administrador')->name('administrador');

        Route::get('/conta/{uniques}', 'UniqueController@conta')->name('conta');

        Route::get('/uni/{NIF}', 'UniqueController@universidade')->name('universidade');
    });
});