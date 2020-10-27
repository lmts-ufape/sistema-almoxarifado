
@extends('../templates.principal')

@section('title')
    Cargo
@endsection

@section('content')

    <a href="{{ route('cargo.create') }} "> <Button> Novo Cargo </Button> </a>
    
    <table border="1">
        <thead>
            <th> Nome </th>
            <th> Mostrar </th>
            <th> Editar </th>
            <th> Remover </th>
        </thead>

        <tbody>
        @foreach($cargos as $cargo)
            <tr>
                <td> {{ $cargo->nome }} </td>
                <td> <a href="{{ route('cargo.show', $cargo->id) }}"> <Button> Mostrar </Button> </a> </td>
                <td> <a href="{{ route('cargo.edit', $cargo->id) }}"> <Button> Editar </Button> </a> </td>
                <td>
                    <form action="{{ route('cargo.destroy', $cargo->id) }}" method="POST">
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