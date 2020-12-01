<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Cargo;
use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Controllers\Img;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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

        $data = [
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


    public function edit_perfil($id) {
        return view('usuario/usuario_edit_perfil', ['usuario' => Usuario::find($id), 'cargos' => Cargo::all()]);
    }

    public function edit_senha($id) {
        return view('usuario/usuario_edit_senha', ['usuario' => Usuario::find($id)]);
    }

    public function update_perfil(Request $request, $id) {

        $usuario = Usuario::find($id);

        $validator = Validator::make($request->all(), Usuario::$rules_edit_perfil, Usuario::$messages);

        if($validator->fails()) {
            redirect()->back()->with('error', ['Error x']);
        }

        // dd($validator);

        // $usuario->fill($data)->Update();

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }

    public function update_senha(Request $request, $id) {
        
        $usuario = Usuario::find($id);

        $validator = Validator::make($request->all(), Usuario::$rules_edit_senha, Usuario::$messages);

        // $usuario->fill($data)->Update();

        return redirect()->back()->with('success', 'Senha atualizada com sucesso!');
    }

    public function update(UsuarioStoreRequest $request, $id)
    {

        $usuario = Usuario::find($id);

        $request->validated();

        $data = [
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'rg' => $request->rg,
            'data_nascimento' => $request->data_nascimento,
            'matricula' => $request->matricula,
            'cargo_id' => $request->cargo,
            'email' => $request->email,
            'senha' => Hash::make($request->senha)
        ];

        $usuario->fill($data)->Update();

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return redirect(route('usuario.index'));
    }

}
