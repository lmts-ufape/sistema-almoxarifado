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

class SolicitacaoController extends Controller
{
    public function show()
    {
        $materiais = material::orderBy('id')->get();
        return view('solicitacao.solicita_material', ['materiais' => $materiais]);
    }

    public function store(Request $request)
    {
        if (empty($request->dataTableMaterial) || empty($request->dataTableQuantidade) || empty($request->dataTableReceptor)) {
            return redirect()->back()->withErrors('Adicione o(s) material(is), sua(s) quantidade(s) e seu(s) receptor(es)');
        } else {
            $materiais = explode(",",  $request->dataTableMaterial);
            $quantidades = explode(",",  $request->dataTableQuantidade);
            $receptores = explode(",",  $request->dataTableReceptor);

            $solicitacao = new Solicitacao();
            $solicitacao->usuario_id = Auth::user()->id;
            $solicitacao->observacao_requerente = $request->observacao;
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
    }

    public function aprovarSolicitacao(Request $request)
    {
        $itemSolicitacaos = session('itemSolicitacoes');
        $itensID = [];
        $quantidadesAprovadas = [];

        if ($request->action == 'nega') {
            if (is_null($request->observacaoAdmin)) {
                return redirect()->back()->withErrors('Informe o motivo de a solicitação ter sido negada');
            } else {
                DB::update('update historico_statuses set status = ?, data_finalizado = ? where solicitacao_id = ?', ["Negado", date('Y-m-d H:i:s'), $request->solicitacaoID]);

                DB::update('update solicitacaos set observacao_admin = ? where id = ?', [$request->observacaoAdmin, $request->solicitacaoID]);         

                if (session()->exists('itemSolicitacoes')) {
                    session()->forget('itemSolicitacoes');
                }
                if (session()->exists('status')) {
                    session()->forget('status');
                }

                return redirect()->back()->with('success', 'Solicitação cancelada com sucesso');
            }
        } else if ($request->action == 'aprova') {
            $checkInputNull = 0;
            $checkQuantMinima = 0;
            $errorMessage = "";

            for ($i = 0; $i < count($itemSolicitacaos); $i++) {
                if (empty($request->quantAprovada[$i])) {
                    $checkInputNull++;
                } else if ($request->quantAprovada[$i] <= $itemSolicitacaos[$i]->quantidade) {
                    array_push($itensID, $itemSolicitacaos[$i]->id);
                    array_push($quantidadesAprovadas, $request->quantAprovada[$i]);
                } else {
                    $checkQuantMinima++;
                    $errorMessage .= $itemSolicitacaos[$i]->nome . "(Dispoível:" . $itemSolicitacaos[$i]->quantidade . ")\n";
                }
            }
            if ($checkInputNull == count($itemSolicitacaos)) {
                return redirect()->back()->withErrors('Informe os valores das quantidades aprovadas');
            } else if ($checkQuantMinima > 0) {
                return redirect()->back()->withErrors("Informe os valores de " . $errorMessage . "em menor quantidade");
            } else {
                for ($i = 0; $i < count($itensID); $i++) {
                    DB::update('update item_solicitacaos set quantidade_aprovada = ? where id = ?', [$quantidadesAprovadas[$i], $itensID[$i]]);
                }

                DB::update('update historico_statuses set status = ?, data_aprovado = ? where solicitacao_id = ?', 
                    [$checkInputNull == 0 ? "Aprovado" : "Aprovado parcialmente", date('Y-m-d H:i:s'),$request->solicitacaoID]);

                DB::update('update solicitacaos set observacao_admin = ? where id = ?', [$request->observacaoAdmin, $request->solicitacaoID]);         

                if (session()->exists('itemSolicitacoes')) {
                    session()->forget('itemSolicitacoes');
                }
                if (session()->exists('status')) {
                    session()->forget('status');
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
            'status' => $historicoStatus
        ]);
    }

    public function listSolicitacoesAnalise()
    {
        $solicitacoes = Solicitacao::where('usuario_id', '!=', Auth::user()->id)->get();
        $historicoStatus = HistoricoStatus::whereIn('solicitacao_id', array_column($solicitacoes->toArray(), 'id'))->where('data_aprovado', null)
            ->where('data_finalizado', null)->orderBy('id')->get();
        $requerentes = Usuario::whereIn('id', array_column($solicitacoes->toArray(), 'usuario_id'))->get();
        return view('solicitacao.analise_solicitacoes', [
            'status' => $historicoStatus, 'requerentes' => $requerentes
        ]);
    }

    public function listSolicitacoesAprovadas()
    {
        $solicitacoes = Solicitacao::where('usuario_id', '!=', Auth::user()->id)->get();
        $historicoStatus = HistoricoStatus::whereIn('solicitacao_id', array_column($solicitacoes->toArray(), 'id'))->where('data_aprovado', '!=',null)
            ->where('data_finalizado', null)->orderBy('id')->get();
        $requerentes = Usuario::whereIn('id', array_column($solicitacoes->toArray(), 'usuario_id'))->get();

        return view('solicitacao.despache_solicitacao', [
            'status' => $historicoStatus, 'requerentes' => $requerentes
        ]);
    }

    public function listTodasSolicitacoes()
    {
        $solicitacoes = Solicitacao::where('usuario_id', '!=', Auth::user()->id)->get();
        $historicoStatus = HistoricoStatus::whereIn('solicitacao_id', array_column($solicitacoes->toArray(), 'id'))->where('data_finalizado', '!=', NULL)->orderBy('id')->get();
        $requerentes = Usuario::whereIn('id', array_column($solicitacoes->toArray(), 'usuario_id'))->get();
        return view('solicitacao.todas_solicitacao', [
            'status' => $historicoStatus, 'requerentes' => $requerentes
        ]);
    }

    public function despacharSolicitacao(Request $request)
    {
        $itens = ItemSolicitacao::where('solicitacao_id', '=', $request->id)->get();
        $materiaisID = array_column($itens->toArray(), 'material_id');
        $quantAprovadas = array_column($itens->toArray(), 'quantidade_aprovada');

        for ($i = 0; $i < count($materiaisID); $i++) {
            DB::update('update estoques set quantidade = quantidade - ? where material_id = ?', [$quantAprovadas[$i], $materiaisID[$i]]);
        }

        DB::update('update historico_statuses set status = ?, data_finalizado = ? where solicitacao_id = ?', 
                    ['Despachado', date('Y-m-d H:i:s'),$request->id]);
    }

    public function cancelarSolicitacao(Request $request)
    {
        DB::update('update historico_statuses set status = ?, data_finalizado = ? where solicitacao_id = ?', 
                    ['Cancelado', date('Y-m-d H:i:s'), $request->id]);
    }

    public static function getItemSolicitacao($id)
    {
        $consulta = DB::select('select item.quantidade_solicitada, item.quantidade_aprovada, mat.nome, mat.descricao
            from item_solicitacaos item, materials mat where item.solicitacao_id = ? and mat.id = item.material_id', [$id]);
        return json_encode($consulta);
    }

    public static function getItemSolicitacaoAdmin($id)
    {
        if (session()->exists('itemSolicitacoes')) {
            session()->forget('itemSolicitacoes');
        }

        $consulta = DB::select('select item.quantidade_solicitada, item.material_id, mat.nome, mat.descricao, item.quantidade_aprovada, item.id, est.quantidade
            from item_solicitacaos item, materials mat, estoques est where item.solicitacao_id = ? and mat.id = item.material_id and est.material_id = item.material_id', [$id]);

        session(['itemSolicitacoes' => $consulta]);

        return json_encode($consulta);
    }

    public static function getObservacaoSolicitacao($id)
    {
        $consulta = DB::select('select observacao_requerente, observacao_admin from solicitacaos where id = ?', [$id]);
        return json_encode($consulta);
    }
}
