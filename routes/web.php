<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth', 'CheckCargoAdministrador'])->group(function () {

    Route::resource('material', 'MaterialController')->except(['show']);
    Route::get('material/index_edit', 'MaterialController@indexEdit')->name('material.indexEdit');

    Route::get('nova_entrada_form', 'MovimentoController@createEntrada')->name('movimento.entradaCreate');
    Route::get('nova_saida_form', 'MovimentoController@createSaida')->name('movimento.saidaCreate');
    Route::get('transferencia_form', 'MovimentoController@createTransferencia')->name('movimento.transferenciaCreate');

    Route::post('movimento_entrada', 'MovimentoController@entradaStore')->name('movimento.entradaStore');
    Route::post('movimento_saida', 'MovimentoController@saidaStore')->name('movimento.saidaStore');
    Route::post('movimento_transferencia', 'MovimentoController@transferenciaStore')->name('movimento.transferenciaStore');

    Route::resource('deposito', 'DepositoController');
    Route::get('get_estoques/{deposito_id}', 'DepositoController@getEstoques')->name('deposito.getEstoque');
    Route::get('consultarDeposito', 'DepositoController@consultarDepositoView')->name('deposito.consultarDeposito');

    Route::resource('cargo', 'CargoController');

    Route::resource('usuario', 'UsuarioController');

    Route::resource('solicita', 'SolicitacaoController');
    Route::get('solicitacoes', 'SolicitacaoController@listAllSolicitacoes')->name('solicitacoes');
    Route::POST('solicitacoes', 'SolicitacaoController@aprovarSolicitacao')->name('aprovar.solicitacao');

    Route::get('despaches', 'SolicitacaoController@listSolicitacoesAprovadas')->name('despaches');
    Route::POST('despache_solicitacao', 'SolicitacaoController@despacharSolicitacao')->name('despache.solicitacao');
    Route::POST('cancela_solicitacao', 'SolicitacaoController@cancelarSolicitacao')->name('cancela.solicitacao');

    Route::get('itens_solicitacao_admin/{id}', 'SolicitacaoController@getItemSolicitacaoAdmin')->name('itens.solicitacao.admin');
    Route::get('observacao_status/{id}', 'SolicitacaoController@getObservacaoStatus')->name('observacao_status');
});

Route::middleware(['auth', 'CheckCargoRequerente'])->group(function () {
    
    Route::resource('solicita', 'SolicitacaoController');
    Route::get('solicita_material', 'SolicitacaoController@show')->name('solicita.material');
    Route::get('consulta_solicitacao', 'SolicitacaoController@listSolicitacoesRequerente')->name('consulta.solicitacao');
    Route::get('itens_solicitacao/{id}', 'SolicitacaoController@getItemSolicitacao')->name('itens.solicitacao');
});

Route::middleware(['auth'])->group(function () {
    
    Route::resource('solicita', 'SolicitacaoController');
    Route::get('observacao_solicitacao/{id}', 'SolicitacaoController@getObservacaoSolicitacao')->name('observacao.solicitacao');
});

Auth::routes();
