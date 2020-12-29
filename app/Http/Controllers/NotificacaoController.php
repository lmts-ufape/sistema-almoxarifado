<?php

namespace App\Http\Controllers;

use App\Notificacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificacaoController extends Controller
{
    public function show($notificacao_id)
    {
        $notificacao = Notificacao::find($notificacao_id);
        $notificacao->visto = true;
        $notificacao->update();

        return view('notificacao.notificacao_show', ['notificacao' => $notificacao]);;
    }

    public function index()
    {
        $notificacoes = DB::table('notificacaos')->where('usuario_id', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        foreach ($notificacoes as $not) {
            if ($not->visto == false) {
                $notificacao = Notificacao::find($not->id);
                $notificacao->visto = true;
                $notificacao->update();
            }
        }
        return view('notificacao.notificacao_index', ['notificacoes' => $notificacoes]);;
    }
}
