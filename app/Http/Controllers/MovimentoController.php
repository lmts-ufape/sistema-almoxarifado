<?php

namespace App\Http\Controllers;

use App\Deposito;
use App\Estoque;
use App\Http\Requests\MovimentoStoreRequest;
use App\itemMovimento;
use App\material;
use App\Movimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimentoController extends Controller
{

    public function createEntrada()
    {
        $materiais = material::all();
        $depositos = Deposito::all();

        return view('movimento.entrada', ['materiais' => $materiais, 'depositos' => $depositos]);
    }

    public function createSaida()
    {
        $materiais = material::all();
        $depositos = Deposito::all();

        return view('movimento.saida', ['materiais' => $materiais, 'depositos' => $depositos]);
    }

    public function entradaStore(MovimentoStoreRequest $request){

        $request = $request->validated();

        $movimentoEntrada = new Movimento();
        $movimentoEntrada->operacao = $request['operacao'];
        $movimentoEntrada->descricao = $request['descricao'];
        // $movimentoEntrada->user_id = $request->user_id;

        $estoque = DB::table('estoques')->where([
                ['deposito_id', '=', $request['deposito_id']],
                ['material_id', '=', $request['material_id']],
            ])->get()->first();

        if($estoque == null){
                $estoque = new Estoque();
                $estoque->quantidade = $request['quantidade'];
                $estoque->material_id = $request['material_id'];
                $estoque->deposito_id = $request['deposito_id'];

            }
        else{
            $estoque = Estoque::findOrFail($estoque->id);
            $estoque->quantidade += $request['quantidade'];
        }

        $movimentoEntrada->save();
        $estoque->save();

        $itemMovimento = new itemMovimento();
        $itemMovimento->quantidade = $request['quantidade'];
        $itemMovimento->material_id = $request['material_id'];
        $itemMovimento->estoque_id = $estoque->id;
        $itemMovimento->movimento_id = $movimentoEntrada->id;

        $itemMovimento->save();
        return redirect()->route('deposito.index');
    }

    public function saidaStore(MovimentoStoreRequest $request){

        $request = $request->validated();

        $movimentoSaida = new Movimento();
        $movimentoSaida->operacao = $request['operacao'];
        $movimentoSaida->descricao = $request['descricao'];
        // $movimentoEntrada->user_id = $request->user_id;

        $estoque = DB::table('estoques')->where([
                ['deposito_id', '=', $request['deposito_id']],
                ['material_id', '=', $request['material_id']],
            ])->get()->first();

        if($estoque != null){
            $estoque = Estoque::findOrFail($estoque->id);
            if($estoque->quantidade - $request['quantidade'] < 0){
                return 'Quantidade solicitada é maior que a disponível em estoque';
            }
            $estoque->quantidade -= $request['quantidade'];
        }
        else{
            return 'Não existe estoque do material selecionado nesse depósito';
        }

        $movimentoSaida->save();
        $estoque->save();

        $itemMovimento = new itemMovimento();
        $itemMovimento->quantidade = $request['quantidade'];
        $itemMovimento->material_id = $request['material_id'];
        $itemMovimento->estoque_id = $estoque->id;
        $itemMovimento->movimento_id = $movimentoSaida->id;

        $itemMovimento->save();
        return redirect()->route('deposito.index');
    }
}
