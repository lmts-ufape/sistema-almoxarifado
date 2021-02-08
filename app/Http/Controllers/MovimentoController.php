<?php

namespace App\Http\Controllers;

use App\Deposito;
use App\Estoque;
use App\itemMovimento;
use App\Material;
use App\Movimento;
use App\Transferencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MovimentoController extends Controller
{
    public function createEntrada()
    {
        $materiais = Material::all();
        $depositos = Deposito::all();

        return view('movimento.entrada', ['materiais' => $materiais, 'depositos' => $depositos]);
    }

    public function createSaida()
    {
        $materiais = Material::all();
        $depositos = Deposito::all();

        return view('movimento.saida', ['materiais' => $materiais, 'depositos' => $depositos]);
    }

    public function createTransferencia()
    {
        $materiais = Material::all();
        $depositos = Deposito::all();

        return view('movimento.transferencia', ['materiais' => $materiais, 'depositos' => $depositos]);
    }

    public function entradaStore(Request $request)
    {
        $validator = Validator::make($request->all(), Movimento::$rules, Movimento::$messages)->validate();

        $movimentoEntrada = new Movimento();
        $movimentoEntrada->operacao = $request['operacao'];
        $movimentoEntrada->descricao = $request['descricao'];

        $estoque = DB::table('estoques')->where([
            ['deposito_id', '=', $request['deposito_id']],
            ['material_id', '=', $request['material_id']],
        ])->get()->first();

        if (null == $estoque) {
            $estoque = new Estoque();
            $estoque->quantidade = $request['quantidade'];
            $estoque->material_id = $request['material_id'];
            $estoque->deposito_id = $request['deposito_id'];
        } else {
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

        return redirect()->route('deposito.consultarDeposito');
    }

    public function saidaStore(Request $request)
    {
        $validator = Validator::make($request->all(), Movimento::$rules, Movimento::$messages)->validate();

        $movimentoSaida = new Movimento();
        $movimentoSaida->operacao = $request['operacao'];
        $movimentoSaida->descricao = $request['descricao'];

        $estoque = DB::table('estoques')->where([
            ['deposito_id', '=', $request['deposito_id']],
            ['material_id', '=', $request['material_id']],
        ])->get()->first();

        if (null != $estoque) {
            $estoque = Estoque::findOrFail($estoque->id);
            if ($estoque->quantidade - $request['quantidade'] < 0) {
                $request->session()->flash('erro', 'Quantidade solicitada é maior que a disponível em estoque');

                return redirect()->route('movimento.saidaCreate');
            }
            $estoque->quantidade -= $request['quantidade'];
        } else {
            $request->session()->flash('erro', 'Não existe um estoque do material selecionado nesse depósito');

            return redirect()->route('movimento.saidaCreate');
        }

        $movimentoSaida->save();
        $estoque->save();

        $itemMovimento = new itemMovimento();
        $itemMovimento->quantidade = $request['quantidade'];
        $itemMovimento->material_id = $request['material_id'];
        $itemMovimento->estoque_id = $estoque->id;
        $itemMovimento->movimento_id = $movimentoSaida->id;

        $itemMovimento->save();

        return redirect()->route('deposito.consultarDeposito');
    }

    public function transferenciaStore(Request $request)
    {
        $validator = Validator::make($request->all(), Transferencia::$rules, Transferencia::$messages)->validate();

        $movimentoSaida = new Movimento();
        $movimentoSaida->operacao = '1';
        $movimentoSaida->descricao = $request['descricao'];

        $movimentoEntrada = new Movimento();
        $movimentoEntrada->operacao = '0';
        $movimentoEntrada->descricao = $request['descricao'];

        $estoqueSaida = DB::table('estoques')->where([
            ['deposito_id', '=', $request['deposito_id_origem']],
            ['material_id', '=', $request['material_id']],
        ])->get()->first();

        if (null != $estoqueSaida) {
            $estoqueSaida = Estoque::findOrFail($estoqueSaida->id);
            if ($estoqueSaida->quantidade - $request['quantidade'] < 0) {
                $request->session()->flash('erro', 'Quantidade solicitada é maior que a disponível em estoque');

                return redirect()->route('movimento.transferenciaCreate');
            }
            $estoqueSaida->quantidade -= $request['quantidade'];
        } else {
            $request->session()->flash('erro', 'Não existe um estoque do material selecionado nesse depósito');

            return redirect()->route('movimento.transferenciaCreate');
        }

        $estoqueEntrada = DB::table('estoques')->where([
            ['deposito_id', '=', $request['deposito_id_destino']],
            ['material_id', '=', $request['material_id']],
        ])->get()->first();

        if (null == $estoqueEntrada) {
            $estoqueEntrada = new Estoque();
            $estoqueEntrada->quantidade = $request['quantidade'];
            $estoqueEntrada->material_id = $request['material_id'];
            $estoqueEntrada->deposito_id = $request['deposito_id_destino'];
        } else {
            $estoqueEntrada = Estoque::findOrFail($estoqueEntrada->id);
            $estoqueEntrada->quantidade += $request['quantidade'];
        }

        $movimentoSaida->save();
        $estoqueSaida->save();
        $movimentoEntrada->save();
        $estoqueEntrada->save();

        $itemMovimentoSaida = new itemMovimento();
        $itemMovimentoSaida->quantidade = $request['quantidade'];
        $itemMovimentoSaida->material_id = $request['material_id'];
        $itemMovimentoSaida->estoque_id = $estoqueSaida->id;
        $itemMovimentoSaida->movimento_id = $movimentoSaida->id;

        $itemMovimentoEntrada = new itemMovimento();
        $itemMovimentoEntrada->quantidade = $request['quantidade'];
        $itemMovimentoEntrada->material_id = $request['material_id'];
        $itemMovimentoEntrada->estoque_id = $estoqueEntrada->id;
        $itemMovimentoEntrada->movimento_id = $movimentoEntrada->id;

        $itemMovimentoEntrada->save();
        $itemMovimentoSaida->save();

        return redirect()->route('deposito.consultarDeposito');
    }
}
