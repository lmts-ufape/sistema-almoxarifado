
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
        <li><b>GERENCIAR CADASTROS</b></li>
        <ul>
            <li><a href="{{ route('material.create') }}">Cadastrar material</a></li>
            <li><a href="{{ route('material.indexEdit') }}">Editar material</a></li>

            <li><a href="{{ route('deposito.create') }}">Cadastrar depósito</a></li>
            <li><a href="{{ route('deposito.create') }}">Editar depósito</a></li>
        </ul>

        <li><b>CONSULTAR</b></li>
        <ul>
            <li><a href="{{ route('material.index') }}">Materiais</a></li>
            <li><a href="{{ route('deposito.index') }}">Depositos</a></li>
        </ul>

        <li><b>GERENCIAR MATERIAIS</b></li>
        <ul>
            <li><a href="{{ route('movimento.entradaCreate') }}">Nova Entrada</a></li>
            <li><a href="{{  route('movimento.saidaCreate') }}">Nova Saída</a></li>
        </ul>
    </ul>

    @yield('content')

    @yield('post-script')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

</body>
</html>

