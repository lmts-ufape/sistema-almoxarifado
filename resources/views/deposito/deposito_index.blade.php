
@extends('../templates.principal')

@section('title')
    Depositos
@endsection

@section('content')

    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>DEPÓSITOS CADASTRADOS</h2>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th> Nome </th>
                <th> Código </th>
                <th> Mostrar </th>
                <th> Editar </th>
                <th> Remover </th>
            </tr>
        </thead>

        <tbody>
        @foreach($depositos as $deposito)
            <tr>
                <td> {{ $deposito->nome }} </td>
                <td> {{ $deposito->codigo }} </td>
                <td> <a href="{{ route('deposito.show', $deposito->id) }}"> <Button> Mostrar </Button> </a></td>
                <td> <a href="{{ route('deposito.edit', $deposito->id) }}"> <Button> Editar </Button> </td>
                <td>
                    <form action="{{ route('deposito.destroy', $deposito->id) }}" method="POST">
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
