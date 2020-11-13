<?php

namespace App\Http\Controllers;

use App\HistoricoStatus;
use App\ItemSolicitacao;
use App\material;
use App\Solicitacao;
use App\Usuario;
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
        $solicitacao->observacao = $request->observacao;
        $solicitacao->save();

        $historicoStatus = new HistoricoStatus();
        $historicoStatus->status = "Aguardando Aprovação";
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

    public function aprovarSolicitacao(Request $request)
    {
        $itemSolicitacaos = session('itemSolicitacoes');
        $itemStatus = session('status');
        $materiaisID = [];
        $quantidadesAprovadas = [];

        if ($itemStatus[0]->status == "Negado" || $itemStatus[0]->status == "Cancelado" || $itemStatus[0]->status == "Finalizado") {
            return redirect()->back()->withErrors('Esta solicitações não pode mais ser alterada');
        } else {
            if ($request->action == 'nega') {
                if (is_null($request->observacao)) {
                    return redirect()->back()->withErrors('Informe o motivo de a solicitação ter sido negada');
                } else {
                    DB::update('update historico_statuses set status = ?, observacao = ? where solicitacao_id = ?', ['Negado', $request->observacao, $request->solicitacaoID]);
                    
                    return redirect()->back()->with('success', 'Solicitação cancelada com sucesso');
                }
            } else if ($request->action == 'aprova') {
                $checkInputNull = 0;
                $checkQuantMinima = 0;
                $errorMessage = "";

                for ($i = 0; $i < count($itemSolicitacaos); $i++) {
                    if (empty($request->quantAprovada[$i])) {
                        $checkInputNull++;
                    } else if ($request->quantAprovada[$i] < $itemSolicitacaos[$i]->quantidade_minima) {
                        array_push($materiaisID, $itemSolicitacaos[$i]->material_id);
                        array_push($quantidadesAprovadas, $request->quantAprovada[$i]);
                    } else {
                        $checkQuantMinima++;
                        $errorMessage .= $itemSolicitacaos[$i]->nome . "(Dispoível:" . $itemSolicitacaos[$i]->quantidade_minima . ")\n";
                    }
                }
                if ($checkInputNull == count($itemSolicitacaos)) {
                    return redirect()->back()->withErrors('Informe os valores das quantidades aprovadas');
                } else if ($checkQuantMinima > 0) {
                    return redirect()->back()->withErrors("Informe os valores de " . $errorMessage . "em menor quantidade");
                } else {
                    for ($i = 0; $i < count($materiaisID); $i++) {
                        DB::update('update item_solicitacaos set quantidade_aprovada = ? where material_id = ?', [$quantidadesAprovadas[$i], $materiaisID[$i]]);
                    }
                    if ($checkInputNull == 0) {
                        DB::update('update historico_statuses set status = ?, observacao = ? where solicitacao_id = ?', ["Aprovado", $request->observacao, $request->solicitacaoID]);
                    } else {
                        DB::update('update historico_statuses set status = ?, observacao = ? where solicitacao_id = ?', ["Aprovado com ressalva", $request->observacao, $request->solicitacaoID]);
                    }
                    if (session()->exists('itemSolicitacoes')) {
                        session()->forget('itemSolicitacoes');
                    }
                    if (session()->exists('status')) {
                        session()->forget('status');
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Solicitação Aprovada com sucesso');
    }

    public function listSolicitacoesRequerente()
    {
        $solicitacoes = Solicitacao::where('usuario_id', '=', Auth::user()->id)->get();
        $historicoStatus = HistoricoStatus::whereIn('solicitacao_id', array_column($solicitacoes->toArray(), 'id'))->orderBy('id')->get();
        return view('solicitacao.consulta_solicitacao', [
            'solicitacoes' => $solicitacoes, 'status' => $historicoStatus
        ]);
    }

    public function listAllSolicitacoes()
    {
        $solicitacoes = Solicitacao::where('usuario_id', '!=', Auth::user()->id)->get();
        $historicoStatus = HistoricoStatus::whereIn('solicitacao_id', array_column($solicitacoes->toArray(), 'id'))->orderBy('id')->get();
        $requerentes = Usuario::whereIn('id', array_column($solicitacoes->toArray(), 'usuario_id'))->get();

        return view('solicitacao.solicitacoes', [
            'solicitacoes' => $solicitacoes, 'status' => $historicoStatus, 'requerentes' => $requerentes
        ]);
    }

    public function listSolicitacoesAprovadas()
    {
        $solicitacoes = Solicitacao::where('usuario_id', '!=', Auth::user()->id)->get();
        $historicoStatus = HistoricoStatus::whereIn('solicitacao_id', array_column($solicitacoes->toArray(), 'id'))->where('status', 'Aprovado')->orWhere('status', 'Aprovado com ressalvas')->orderBy('id')->get();
        $requerentes = Usuario::whereIn('id', array_column($solicitacoes->toArray(), 'usuario_id'))->get();

        return view('solicitacao.despaches', [
            'solicitacoes' => $solicitacoes, 'status' => $historicoStatus, 'requerentes' => $requerentes
        ]);
    }

    public function despacharSolicitacao(Request $request)
    {
        $itens = ItemSolicitacao::where('solicitacao_id', '=', $request->id)->get();
        $materiaisID = array_column($itens->toArray(), 'material_id');
        $quantAprovadas = array_column($itens->toArray(), 'quantidade_aprovada');
        
        for($i = 0; $i < count($materiaisID); $i++) {
            DB::update('update materials set quantidade_minima = quantidade_minima - ? where id = ?', [$quantAprovadas[$i], $materiaisID[$i]]);
        }

        DB::update('update historico_statuses set status =  ? where solicitacao_id = ?', ["Finalizado", $request->id]);
    }

    public function cancelarSolicitacao(Request $request)
    {
        DB::update('update historico_statuses set status =  ? where solicitacao_id = ?', ["Cancelado", $request->id]);
    }

    public static function getItemSolicitacao($id)
    {
        $consulta = DB::select('select item.quantidade_solicitada, item.quantidade_aprovada, item.material_id, mat.nome, mat.descricao
            from item_solicitacaos item, materials mat where item.solicitacao_id = ? and mat.id = item.material_id', [$id]);
        return json_encode($consulta);
    }

    public static function getItemSolicitacaoAdmin($id)
    {
        if (session()->exists('itemSolicitacoes')) {
            session()->forget('itemSolicitacoes');
        }

        $consulta = DB::select('select item.quantidade_solicitada, item.material_id, mat.nome, mat.descricao, mat.quantidade_minima, item.quantidade_aprovada
            from item_solicitacaos item, materials mat where item.solicitacao_id = ? and mat.id = item.material_id', [$id]);

        session(['itemSolicitacoes' => $consulta]);

        return json_encode($consulta);
    }

    public static function getObservacaoSolicitacao($id)
    {
        $consulta = DB::select('select observacao from solicitacaos where id = ?', [$id]);
        return json_encode($consulta);
    }

    public static function getObservacaoStatus($id)
    {
        if (session()->exists('status')) {
            session()->forget('status');
        }

        $consulta = DB::select('select observacao, status from historico_statuses where solicitacao_id = ?', [$id]);

        session(['status' => $consulta]);

        return json_encode($consulta);
    }
}
