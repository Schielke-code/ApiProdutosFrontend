<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', ['uses' => 'ProdutosController@index', 'as' => 'index']);
Route::group(['prefix'=>'produtos'], function(){
    Route::get('/create', ['uses' => 'ProdutosController@create', 'as' => 'produtos.create']);
    Route::get('/list', ['uses' => 'ProdutosController@list', 'as' => 'produtos.list']);
    Route::post('/store', ['uses' => 'ProdutosController@store', 'as' => 'produtos.store']);
    Route::get('/delete/{id?}', ['uses' => 'ProdutosController@destroy', 'as' => 'produtos.delete']);
});
