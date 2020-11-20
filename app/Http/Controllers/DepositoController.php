<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposito;

use App\Estoque;
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

    public function store(Request $request)
    {

        $cadastro = ['nome' => $request->nome, 'codigo' => $request->codigo];

        // Falta Validar os Dados

        Deposito::create($cadastro);

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

    public function update(Request $request, $id)
    {

        $deposito = Deposito::find($id);
        $cadastro = ['nome' => $request->nome, 'codigo' => $request->codigo];


        // Falta Validar os Dados

        $deposito->fill($cadastro)->save();

        return redirect(route('deposito.index'));
    }

    public function destroy($id)
    {

        Deposito::destroy($id);

        return redirect(route('deposito.index'));
    }
}
