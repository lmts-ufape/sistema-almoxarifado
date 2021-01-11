<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cargo;

class CargoController extends Controller {

    public function index() {
        return view('cargo/cargo_index', ['cargos' => Cargo::all()]);
    }

    public function create() {
        return view('cargo/cargo_create');
    }

    public function store(Request $request) {
        
        $cadastro = ['nome' => $request->nome];

        Cargo::create($cadastro);

        return redirect(route('cargo.index'));
    }

    public function show($id) {
        return view('cargo/cargo_show', ['cargo' => Cargo::find($id)]);
    }
    
    public function edit($id) {
        return view('cargo/cargo_edit', ['cargo' => Cargo::find($id)]);
    }

    public function update(Request $request, $id) {

        $cargo = Cargo::find($id);
        $cadastro = ['nome' => $request->nome];

        $cargo->fill($cadastro)->save();

        return redirect(route('cargo.index'));
    }

    public function destroy($id) {
        
        Cargo::destroy($id);
        
        return redirect(route('cargo.index'));
    }
}
