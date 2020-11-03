<?php

namespace App\Http\Controllers;

use App\HistoricoStatus;
use App\ItemSolicitacao;
use App\material;
use App\Solicitacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SolicitacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $materiais = material::all();
        return view('solicitacao.solicita_material', ['materiais' => $materiais]);
    }

    public function store(Request $request)
    {
        $materiais = explode(",",  $request->dataTableMaterial);
        $quantidades = explode(",",  $request->dataTableQuantidade);
        $receptores = explode(",",  $request->dataTableReceptor);

        $solicitacao = new Solicitacao();
        $solicitacao->save();

        for ($i = 0; $i < count($materiais); $i++) {

            $itemSolicitacao = new ItemSolicitacao();
            $itemSolicitacao->quantidade_solicitada = $quantidades[$i];
            $itemSolicitacao->material_id = $materiais[$i];
            $itemSolicitacao->solicitacao_id = $solicitacao->id;
            $itemSolicitacao->save();

            $historicoStatus = new HistoricoStatus();
            $historicoStatus->status = "Aguardando Aprovação";
            $historicoStatus->observacao = $request->observacao;
            $historicoStatus->receptor = $receptores[$i];
            $historicoStatus->solicitacao_id = $solicitacao->id;
            $historicoStatus->save();
        }
        return redirect()->back()->with('success', 'Solicitação feita com sucesso');
    }
}
