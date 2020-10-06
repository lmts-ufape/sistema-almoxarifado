<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almoxarifado - @yield('title')</title>
</head>
<body>
    <ul>
        <li><a href="{{ route('home') }}"><b>PÁGINA INICIAL</b></a></li>
        <li><b>CADASTRAR</b></li>
        <ul>
            <li><a href="{{ route('material.create') }}">Cadastrar material</a></li>
            <li><a href="{{ route('deposito.create') }}">Cadastrar deposito</a></li>
        </ul>

        <li><b>CONSULTAR</b></li>
        <ul>
            <li><a href="{{ route('material.index') }}">Materiais</a></li>
            <li><a href="{{ route('deposito.index') }}">Depositos</a></li>
        </ul>

        <li><b>GERENCIAR MATERIAIS</b></li>
        <ul>
            <li><a href="{{ route('estoque.create') }}">Entrada</a></li>
            {{-- <li><a href="{{ route('estoque.edit') }}">Saída</a></li> --}}
        </ul>
    </ul>

    @yield('content')

</body>
</html>
