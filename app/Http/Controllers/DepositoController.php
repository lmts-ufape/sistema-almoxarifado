<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposito;

class DepositoController extends Controller {

    public function index() {
        return view('deposito/deposito_index', ['depositos' => Deposito::all()]);
    }

    public function create() {
        return view('deposito/deposito_create');
    }

    public function store(Request $request) {
        
        $cadastro = ['nome' => $request->nome, 'codigo' => $request->codigo];

        // Falta Validar os Dados

        Deposito::create($cadastro);

        return redirect(route('deposito.index'));
    }

    public function show($id) {
        return view('deposito/deposito_show', ['deposito' => Deposito::find($id)]);
    }

    public function edit($id) {
        return view('deposito/deposito_edit', ['deposito' => Deposito::find($id)]);
    }

    public function update(Request $request, $id) {

        $deposito = Deposito::find($id);
        $cadastro = ['nome' => $request->nome];

        // Falta Validar os Dados
        
        $deposito->fill($cadastro)->save();

        return redirect(route('deposito.index'));
    }

    public function destroy($id) {
        
        Deposito::destroy($id);
        
        return redirect(route('deposito.index'));
    }
    
}
