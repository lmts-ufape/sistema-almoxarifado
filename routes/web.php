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
    return view('index');
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('material', 'MaterialController')->except(['show']);
Route::get('material/index_edit', 'MaterialController@indexEdit')->name('material.indexEdit');


Route::get('nova_entrada_form', 'MovimentoController@createEntrada')->name('movimento.entradaCreate');
Route::get('nova_saida_form', 'MovimentoController@createSaida')->name('movimento.saidaCreate');
Route::get('transferencia_form', 'MovimentoController@createTransferencia')->name('movimento.transferenciaCreate');

Route::post('movimento_entrada', 'MovimentoController@entradaStore')->name('movimento.entradaStore');
Route::post('movimento_saida', 'MovimentoController@saidaStore')->name('movimento.saidaStore');
Route::post('movimento_transferencia', 'MovimentoController@transferenciaStore')->name('movimento.transferenciaStore');

Route::resource('deposito', 'DepositoController');
Route::get('get_estoques/{deposito_id}', 'DepositoController@getEstoques' )->name('deposito.getEstoque');
Route::get('consultarDeposito', 'DepositoController@consultarDepositoView')->name('deposito.consultarDeposito');

Route::resource('cargo', 'CargoController');

Route::resource('usuario', 'UsuarioController');

Route::resource('solicita', 'SolicitacaoController');
Route::get('solicita_material', 'SolicitacaoController@show')->name('solicita.material');
