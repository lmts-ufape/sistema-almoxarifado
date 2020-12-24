<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposito;

use App\Estoque;
use App\Http\Requests\DepositoStore;
use Illuminate\Support\Facades\DB;

class DepositoController extends Controller
{

    public function index()
    {
        return view('deposito/deposito_index', ['depositos' => Deposito::all(), 'estoques' => Estoque::all()]);
    }

    public function consultarDepositoView()
    {
        $depositos = new Deposito();
        $depositos = $depositos->all();
        $estoques = Estoque::all();

        return view('deposito.deposito_consult', compact('depositos', 'estoques'));
    }

    public function getEstoques($deposito_id)
    {
        $estoques = DB::select('Select mat.nome, e.quantidade from estoques e, materials mat where e.deposito_id = ? and mat.id = e.material_id', [$deposito_id]);

        return response()->json($estoques);
    }

    public function create()
    {
        return view('deposito/deposito_create');
    }

    public function store(DepositoStore $request)
    {
        $data = $request->validated();

        Deposito::create($data);

        return redirect(route('deposito.index'));
    }

    public function show($id)
    {
        return view('deposito/deposito_show', ['deposito' => Deposito::find($id)]);
    }

    public function edit($id)
    {
        return view('deposito/deposito_edit', ['deposito' => Deposito::find($id)]);
    }

    public function update(DepositoStore $request, $id)
    {
        $data = $request->validated();
        $deposito = Deposito::find($id);

        $deposito->fill($data)->save();

        return redirect(route('deposito.index'))->with('sucess', 'Deposito alterado com sucesso!');
    }

    public function destroy($id)
    {
        $estoques = Estoque::all()->where('deposito_id', '=', $id)->first();
        if (empty($estoques)) {
            $deposito = Deposito::all()->find($id);
            $deposito->delete();
            return redirect(route('deposito.index'))->with('sucess', 'Desposito removido com sucesso!');
        } else{
            return redirect()->back()->with('fail', 'Deposito não vazio, não é possivel remover!');
        }


    }
}
