<?php

namespace App\Http\Controllers;

use App\Estoque;
use App\itemMovimento;
use App\Movimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimentoController extends Controller
{
    public function entradaStore(Request $request){

        // dd($request->all());

        $movimentoEntrada = new Movimento();
        $movimentoEntrada->operacao = $request->operacao;
        $movimentoEntrada->descricao = $request->descricao;
        // $movimentoEntrada->user_id = $request->user_id;

        $estoque = DB::table('estoques')->where([
                ['deposito_id', '=', $request->deposito_id ],
                ['material_id', '=', $request->material_id],
            ])->get()->first();

        if($estoque == null){
                $estoque = new Estoque();
                $estoque->quantidade = $request->quantidade;
                $estoque->material_id = $request->material_id;
                $estoque->deposito_id = $request->deposito_id;

            }
        else{
            $estoque = Estoque::findOrFail($estoque->id);
            $estoque->quantidade += $request->quantidade;
        }

        $movimentoEntrada->save();
        $estoque->save();

        $itemMovimento = new itemMovimento();
        $itemMovimento->quantidade = $request->quantidade;
        $itemMovimento->material_id = $request->material_id;
        $itemMovimento->estoque_id = $estoque->id;
        $itemMovimento->movimento_id = $movimentoEntrada->id;

        $itemMovimento->save();
        return redirect()->route('deposito.index');
    }
}
