<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('usuario', 'UsuarioController');

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

    Route::resource('solicita', 'SolicitacaoController');
    Route::get('analise_solicitacoes', 'SolicitacaoController@listSolicitacoesAnalise')->name('analise.solicitacoes');
    Route::POST('analise_solicitacoes', 'SolicitacaoController@aprovarSolicitacao')->name('aprovar.solicitacao');
    Route::get('despache_solicitacoes', 'SolicitacaoController@listSolicitacoesAprovadas')->name('despache.solicitacoes');
    Route::POST('despache_solicitacao', 'SolicitacaoController@despacharSolicitacao')->name('despache.solicitacao');
    Route::POST('cancela_solicitacao', 'SolicitacaoController@cancelarSolicitacao')->name('cancela.solicitacao');
    Route::get('itens_solicitacao_admin/{id}', 'SolicitacaoController@getItemSolicitacaoAdmin')->name('itens.solicitacao.admin');
    Route::get('solicitacoes_admin', 'SolicitacaoController@listTodasSolicitacoes')->name('solicitacoe.admin');
});

Route::middleware(['auth', 'CheckCargoRequerente'])->group(function () {
    Route::resource('solicita', 'SolicitacaoController');
    Route::get('editar_perfil/{user_id}', 'UsuarioController@edit')->name('perfil.editar');;
    Route::get('solicita_material', 'SolicitacaoController@show')->name('solicita.material');
    Route::get('minhas_solicitacoes', 'SolicitacaoController@listSolicitacoesRequerente')->name('minhas.solicitacoes');
    Route::get('itens_solicitacao/{id}', 'SolicitacaoController@getItemSolicitacao')->name('itens.solicitacao');
});

Route::middleware(['auth'])->group(function () {

    Route::resource('solicita', 'SolicitacaoController');
    Route::get('observacao_solicitacao/{id}', 'SolicitacaoController@getObservacaoSolicitacao')->name('observacao.solicitacao');
});

Auth::routes();
