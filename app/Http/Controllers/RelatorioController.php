<?php

namespace App\Http\Controllers;

use App\Deposito;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RelatorioController extends Controller
{
    public function materiais()
    {
        return view('relatorio.materiais');
    }

    public function gerarRelatorioMateriais(Request $request)
    {
        Log::info($request);

        Validator::make($request->all(), 
            ["data_inicio" => "required", "date", "data_fim" => "required", "date"], 
            ["data_inicio.required" => "A data de início deve ser informada", 
            "data_fim.required" => "A data de fim deve ser informada"])->validate();

        $depositos = Deposito::select("id")->get();
        $depositosID = implode(",", array_column($depositos->toArray(), "id"));

        $consulta = DB::select("select dep.nome as nomeDep, mat.nome as nomeMat, mat.codigo, mat.descricao, est.quantidade, mat.imagem from materials mat, estoques est, depositos dep
        where dep.id in (" . $depositosID . ") and dep.id = est.deposito_id and est.material_id = mat.id 
        and est.created_at between '". $request->data_inicio ."' and '". $request->data_fim ."' order by dep.id");

        $materiais = [];

        foreach ($consulta as $i) {
            if (array_key_exists($i->nomedep, $materiais)) {
                array_push($materiais[$i->nomedep], $i);
            } else {
                $materiais[$i->nomedep] = [$i];
            }
        }
        
        $pdf = PDF::loadView('/relatorio/todos_materiais_base', compact('materiais'));

        return $pdf->setPaper('a4')->stream('Relatório_Materais');
    }
}
