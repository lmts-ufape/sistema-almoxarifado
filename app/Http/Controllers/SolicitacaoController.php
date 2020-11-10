<?php

namespace App\Http\Controllers;

use App\HistoricoStatus;
use App\ItemSolicitacao;
use App\material;
use App\Solicitacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SolicitacaoController extends Controller
{
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
        $solicitacao->usuario_id = Auth::user()->id;
        $solicitacao->save();

        $historicoStatus = new HistoricoStatus();
        $historicoStatus->status = "Aguardando Aprovação";
        $historicoStatus->observacao = $request->observacao;
        $historicoStatus->solicitacao_id = $solicitacao->id;
        $historicoStatus->save();

        for ($i = 0; $i < count($materiais); $i++) {

            $itemSolicitacao = new ItemSolicitacao();
            $itemSolicitacao->quantidade_solicitada = $quantidades[$i];
            $itemSolicitacao->receptor = $receptores[$i];
            $itemSolicitacao->material_id = $materiais[$i];
            $itemSolicitacao->solicitacao_id = $solicitacao->id;
            $itemSolicitacao->save();
        }
        return redirect()->back()->with('success', 'Solicitação feita com sucesso');
    }

    public function list()
    {
        $solicitacoes = Solicitacao::where('usuario_id', '=', Auth::user()->id)->get();
        $historicoStatus = HistoricoStatus::whereIn('solicitacao_id', array_column($solicitacoes->toArray(), 'id'))->orderBy('id')->get();
        return view('solicitacao.consulta_solicitacao', [
            'solicitacoes' => $solicitacoes, 'status' => $historicoStatus
        ]);
    }

    public static function getItemSolicitacao($id)
    {
        $consulta = DB::select('select item.quantidade_solicitada, item.quantidade_aprovada, item.material_id, mat.nome, mat.descricao
            from item_solicitacaos item, materials mat where item.solicitacao_id = ? and mat.id = item.material_id', [$id]);
        return json_encode($consulta);
    }

    public static function getStatusSolicitacao($id)
    {
        $consulta = DB::select('select status.observacao from historico_statuses status where status.solicitacao_id = ?', [$id]);
        return json_encode($consulta);
    }
}
