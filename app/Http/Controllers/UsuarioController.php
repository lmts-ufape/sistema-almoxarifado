<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuario;
use App\Cargo;
use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Controllers\Img;

class UsuarioController extends Controller {

    public function index() {
        return view('usuario/usuario_index', ['usuarios' => Usuario::all()]);
    }

    public function create() {
        return view('usuario/usuario_create', ['cargos' => Cargo::all()]);
    }

    public function store(UsuarioStoreRequest $request) {

        $validatedFields = $request->validated();

        if( ($request->hasFile('imagem') && $request->file('imagem')->isValid()) ) {

            $imgExtension = $request->imagem->extension();
            $imgName = Img::nameNewImage(Usuario::all(), $request->nome, $imgExtension);

            $request->imagem->storeAs(Img::usuariosDir(), $imgName);
            $request->imagem = $imgName;

        }

        $data = [
            'imagem' => $request->imagem,
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'rg' => $request->rg,
            'data_nascimento' => $request->data_nascimento,
            'matricula' => $request->matricula,
            'cargo_id' => $request->cargo,
            'email' => $request->email,
            'senha' => $request->senha,
        ];

        Usuario::create($data);

        return redirect(route('usuario.index'));
    }

    public function show($id) {
        return view('usuario/usuario_show', ['usuario' => Usuario::find($id)]);
    }

    public function edit($id) {

    }

    public function update(Request $request, $id) {

    }

    public function destroy($id) {
        Usuario::destroy($id);
        return redirect(route('usuario.index'));
    }

}
