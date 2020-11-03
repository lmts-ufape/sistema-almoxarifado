
@extends('../templates.principal')

@section('title')
    Usuario
@endsection

@section('content')

    <table>
        <thead>
            <tr>
                <th> Foto </th>
                <th> Nome </th>
                <th> Email </th>
                <th> Cargo </th>
            </tr>
        </thead>

        <tbody>
        @foreach($usuarios as $usuario)
            <tr>  
                <td> <img src="{{ url('storage/img/usuarios/'.$usuario->imagem) }}" alt="{{ $usuario->imagem }}" width="80" height="80"></td>
                <td> {{ $usuario->nome }} </td>
                <td> {{ $usuario->email }} </td>
                <td> {{ $usuario->getCargo($usuario->cargo_id)->nome }} </td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection