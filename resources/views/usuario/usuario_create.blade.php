
@extends('../templates.principal')

@section('title')
    Usuario Create
@endsection

@section('content')

    <form action="{{ route('usuario.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="">
            <label> Dados Institucionais / Pessoais </label>
        </div>

        <div class="">
            <label for="imagem"> Add uma img: </label>
            <input type="file" name="imagem" id="imagem" accept=".png, .jpg, .jpeg, .svg, .dib, .bmp">
        </div>
        
        <div class="">
            <label for="nome"> Nome: </label>
            <input type="text" name="nome" id="nome">
        </div>

        <div class="">
            <label for="cpf"> CPF: </label>
            <input type="text" name="cpf" id="cpf">
        </div>

        <div class="">
            <label for="rg"> RG: </label>
            <input type="text" name="rg" id="rg">
        </div>

        <div class="">
            <label for="data_nascimento"> Data de Nascimento: </label>
            <input type="date" name="data_nascimento" id="data_nascimento">
        </div>

        <div class="">
            <label for="matricula"> Matrícula: </label>
            <input type="number" name="matricula" id="matricula">
        </div>

        <div class="">
            <label for="cargo"> Cargo: </label>
            <select name="cargo" id="cargo">
            @foreach( $cargos as $cargo )
                <option value="{{ $cargo->id }}"> {{ $cargo->nome }} </option>
            @endforeach
            </select>
        </div>

        <div class="">
            <label> Dados de Login <label>
        </div>

        <div class="">
            <label for="email"> Email: </label>
            <input type="email" name="email" id="email">
        <div>

        <div class="">
            <label for="senha"> Senha: </label>
            <input type="password" name="senha" id="senha">
        </div>

        <div class="">
            <label for="confimar_senha"> Confirmar Senha: </label>
            <input type="password" name="confirmar_senha" id="confirmar_senha">
        </div>

        <div class="">
            <Button type="submit"> Cadastrar </Button>
        </div>

    </form>

@endsection