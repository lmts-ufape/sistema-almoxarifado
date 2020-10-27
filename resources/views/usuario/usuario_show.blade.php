
@extends('../templates.principal')

<h1> Perfil: {{ $usuario->nome }} </h1>

<img src= "{{ url('storage/img/usuarios/'.$usuario->imagem) }}" alt="{{ $usuario->imagem }}" width="100" height="100"></img>
<p> Nome: {{ $usuario->nome }} </p>
<p> CPF: {{ $usuario->cpf }} </p>
<p> RG: {{ $usuario->rg }} </p>
<p> Data_Nascimento: {{ $usuario->data_nascimento }} </p>
<p> Matricula: {{ $usuario->matricula }} </p>
<p> Cargo: {{ $usuario->getCargo($usuario->cargo_id)->nome }} </p>
<p> E-mail: {{ $usuario->email }} </p>
<p> Senha: {{ $usuario->senha }} </p>