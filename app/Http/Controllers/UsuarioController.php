<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Cargo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Usuario::$rules, Usuario::$messages)->validate();

        $data = [
            'nome' => $request['nome'],
            'email' => $request['email'],
            'cpf' => $request['cpf'],
            'rg' => $request['rg'],
            'data_nascimento' => $request['data_nascimento'],
            'matricula' => $request['matricula'],
            'cargo_id' => $request['cargo'],
            'numTel' => $request['numTel'],
            'senha' => Hash::make($request->password),
            'setor' => $request['setor']
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


    public function edit_perfil($id)
    {
        return view('usuario/usuario_edit_perfil', ['usuario' => Usuario::find($id), 'cargos' => Cargo::all()]);
    }

    public function edit_senha($id)
    {
        return view('usuario/usuario_edit_senha', ['usuario' => Usuario::find($id)]);
    }

    public function update_perfil(Request $request, $id)
    {

        $usuario = Usuario::find($id);

        $rules = array_slice(Usuario::$rules, 0, 6);
        $messages = array_slice(Usuario::$messages, 0, 23);

        $rules['email'] = [
            'required', 'email', 'min:5', 'max:100',
            Rule::unique('usuarios')->ignore($usuario->id),
        ];

        $rules['cpf'] = [
            'required', 'numeric', 'min:0', 'digits_between:10,11',
            Rule::unique('usuarios')->ignore($usuario->id),
        ];

        $rules['rg'] = [
            'required', 'numeric', 'min:0', 'digits_between:7,11',
            Rule::unique('usuarios')->ignore($usuario->id),
        ];

        $rules['matricula'] = [
            'required', 'integer', 'min:1',
            Rule::unique('usuarios')->ignore($usuario->id),
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        $data = [
            'nome' => $request['nome'],
            'email' => $request['email'],
            'cpf' => $request['cpf'],
            'rg' => $request['rg'],
            'data_nascimento' => $request['data_nascimento'],
            'matricula' => $request['matricula'],
            'numTel' => $request['numTel'],
            'setor' => $request['setor']
        ];

        $usuario->fill($data)->Update();

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }

    public function update_senha(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        $rules = array_slice(Usuario::$rules, 7);
        $messages = array_slice(Usuario::$messages, 27);

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        $usuario->senha = Hash::make($request->password);

        $usuario->save();

        return redirect()->back()->with('success', 'Senha atualizada com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        $rules = array_slice(Usuario::$rules, 0, 6);
        $messages = array_slice(Usuario::$messages, 0, 23);

        $rules['email'] = [
            'required', 'email', 'min:5', 'max:100',
            Rule::unique('usuarios')->ignore($usuario->id),
        ];

        $rules['cpf'] = [
            'required', 'numeric', 'min:0', 'digits_between:10,11',
            Rule::unique('usuarios')->ignore($usuario->id),
        ];

        $rules['rg'] = [
            'required', 'numeric', 'min:0', 'digits_between:7,11',
            Rule::unique('usuarios')->ignore($usuario->id),
        ];

        $rules['matricula'] = [
            'required', 'integer', 'min:1',
            Rule::unique('usuarios')->ignore($usuario->id),
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        $data = [
            'email' => $request['email'],
            'nome' => $request['nome'],
            'cpf' => $request['cpf'],
            'rg' => $request['rg'],
            'data_nascimento' => $request['data_nascimento'],
            'matricula' => $request['matricula'],
            'cargo_id' => $request['cargo'],
            'numTel' => $request['numTel'],
            'senha' => Hash::make($request['password']),
            'setor' => $request['setor']
        ];

        $usuario->fill($data)->Update();

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $usuario = Usuario::all()->find($id);
        $usuario->delete();

        return redirect(route('usuario.index'));
    }
}
