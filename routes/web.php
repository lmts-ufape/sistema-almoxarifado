<?php

use Doctrine\DBAL\Schema\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){

    Route::resource('usuario', 'UsuarioController');
    Route::get('usuario/{id}/edit_perfil', 'UsuarioController@edit_perfil')->name('usuario.edit_perfil');
    Route::get('usuario/{id}/edit_senha', 'UsuarioController@edit_senha')->name('usuario.edit_senha');
    Route::get('usuario/{id}/remover', 'UsuarioController@destroy')->name('usuario.destroy');
    Route::put('usuario/update_perfil/{id}', 'UsuarioController@update_perfil')->name('usuario.update_perfil');
    Route::put('usuario/update_senha/{id}', 'UsuarioController@update_senha')->name('usuario.update_senha');

    Route::get('/', function () {
        return view('home');
    })->name('home');

});
    Route::get('sistema', function () {
        return view('infos.sistema');
    })->name('sistema');
    Route::get('parceria', function () {
        return view('infos.parceria');
    })->name('parceria');
    Route::get('contato', function () {
        return view('infos.contato');
    })->name('contato');

Route::middleware(['auth', 'CheckCargoAdministrador'])->group(function () {

    Route::resource('notificacao', 'NotificacaoController');
    Route::get('notificacao/{notificacao_id}', 'NotificacaoController@show')->name('notificacao.show');
    Route::get('notificacoes', 'NotificacaoController@index')->name('notificacao.index');

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

    Route::get('retira_solicitacoes', 'SolicitacaoController@listSolicitacoesAprovadas')->name('retira.solicitacoes');
    Route::POST('entrega_solicitacao', 'SolicitacaoController@despacharSolicitacao')->name('entrega.solicitacao');
    Route::POST('cancela_entrega_solicitacao', 'SolicitacaoController@cancelarSolicitacao')->name('cancela.entrega.solicitacao');

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

Route::middleware(['auth', 'CheckCargoAdminDiretoria'])->group(function () {
    Route::get('relatorio.materiais', 'RelatorioController@relatorio_escolha')->name('relatorio.materiais');
    Route::POST('relatorio.materiais', 'RelatorioController@gerarRelatorioMateriais')->name('relatorio.materiais');
});

Route::middleware(['auth'])->group(function () {

    Route::get('observacao_solicitacao/{id}', 'SolicitacaoController@getObservacaoSolicitacao')->name('observacao.solicitacao');
});

Auth::routes();
