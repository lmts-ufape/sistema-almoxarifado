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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('material', 'MaterialController')->except(['show']);
Route::get('material/index_edit', 'MaterialController@indexEdit')->name('material.indexEdit');

Route::resource('estoque', 'EstoqueController');

Route::post('movimento_entrada', 'MovimentoController@entradaStore')->name('movimento.entradaStore');

Route::resource('deposito', 'DepositoController');
Route::get('get_estoques/{deposito_id}', 'DepositoController@getEstoques' )->name('deposito.getEstoque');
