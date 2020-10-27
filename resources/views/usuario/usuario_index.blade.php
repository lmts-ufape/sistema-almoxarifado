
@extends('../templates.principal')

@section('title')
    Usuario
@endsection

@section('content')

    <a href="{{ route('usuario.create') }}"> <Button> Novo Usuário </Button> </a>

    <table border="1">
        <thead>
            <tr>
                <th> Nome </th>
                <th> Email </th>
                <th> Cargo </th>
                <th> Mostrar </th>
                <th> Editar </th>
                <th> Remover </th>
            </tr>
        </thead>

        <tbody>
        @foreach($usuarios as $usuario)
            <tr>  
                <td> {{ $usuario->nome }} </td>
                <td> {{ $usuario->email }} </td>
                <td> {{ $usuario->getCargo($usuario->cargo_id)->nome }} </td>
                <td> <a href="{{ route('usuario.show', $usuario->id) }}"> <Button> Mostrar </Button> </a> </td>
                <td> <a href="{{ route('usuario.edit', $usuario->id) }}"> <Button> Editar </Button> </a> </td>
                <td> 
                    <form action="{{ route('usuario.destroy', $usuario->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <Button type="submit"> Remover </Button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection