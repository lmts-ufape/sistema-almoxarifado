<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function materiais()
    {
        return view('relatorio.materiais');
    }

    public function gerarRelatorioMateriais(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                "data_inicio" => "required", "date",
                "data_fim" => "required", "date",
                "tipo_relatorio" => "required"
            ],
            [
                "data_inicio.required" => "A data de início deve ser informada",
                "data_fim.required" => "A data de fim deve ser informada",
                "tipo_relatorio.required" => "Escolha um tipo de relatório"
            ]
        )->validate();

        $datas = [$request->data_inicio, $request->data_fim];

        $materiais = DB::select("select dep.nome as nomeDep, mat.nome as nomeMat, mat.descricao, mat.codigo, itensMov.quantidade
        from materials mat, depositos dep, item_movimentos itensMov, movimentos mov, estoques est
        where mov.created_at between '" . $request->data_inicio . "' and '" . $request->data_fim . "' and mov.operacao = ? and itensMov.movimento_id = mov.id and itensMov.material_id = mat.id and 
        itensMov.estoque_id = est.id and est.deposito_id = dep.id", [$request->tipo_relatorio]);

        $tipo_relatorio = $request->tipo_relatorio;

        $pdf = PDF::loadView('/relatorio/base_relatorio', compact('materiais', 'datas', 'tipo_relatorio'));

        return $pdf->setPaper('a4')->stream('Relatório_Materais.pdf');
    }
}
