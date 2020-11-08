<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'cpf' => ['required', 'string'],
            'rg' => ['required', 'string'],
            'data_nascimento' => ['required', 'string'],
            'matricula' => ['required', 'string'],
            'imagem' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Usuario::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'cpf' => $data['cpf'],
            'rg' => $data['rg'],
            'data_nascimento' => $data['data_nascimento'],
            'matricula' => $data['matricula'],
            'imagem' => $data['imagem'],
            'senha' => Hash::make($data['password']),
            'cargo_id' => 1
        ]);
    }
}
