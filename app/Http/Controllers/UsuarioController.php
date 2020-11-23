<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Cargo;
use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Controllers\Img;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UsuarioController extends Controller
{

    public function index()
    {
        if (Gate::allows('read-usuario')) {
            return view('usuario/usuario_index', ['usuarios' => Usuario::all()]);
        } else if (Gate::denies('read-usuario')) {
            abort('403', 'Não Autorizado');
        }
    }

    public function create()
    {
        return view('usuario/usuario_create', ['cargos' => Cargo::all()]);
    }

    public function store(UsuarioStoreRequest $request)
    {

        $validatedFields = $request->validated();

        if (($request->hasFile('imagem') && $request->file('imagem')->isValid())) {

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
            'senha' => Hash::make($request->senha)
        ];

        Usuario::create($data);

        return redirect(route('usuario.index'));
    }

    public function show($id)
    {
        if (Gate::allows('read-usuario')) {
            return view('usuario/usuario_show', ['usuario' => Usuario::find($id)]);
        } else if (Gate::denies('read-usuario')) {
            abort('403', 'Não Autorizado');
        }
    }

    public function edit($id)
    {

        if (Gate::allows('update-usuario', $id)) {
            return view('usuario/usuario_edit', ['usuario' => Usuario::find($id), 'cargos' => Cargo::all()]);
        } else if (Gate::denies('update-usuario', $id)) {
            abort('403', 'Não Autorizado');
        }
    }

    public function update(UsuarioStoreRequest $request, $id)
    {

        $usuario = Usuario::find($id);

        $request->validated();

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {

            $imgName = Img::nameUpdateImage($id, $request->nome, $request->imagem->extension());
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
            'senha' => Hash::make($request->senha)
        ];

        $usuario->fill($data)->save();

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return redirect(route('usuario.index'));
    }

}
