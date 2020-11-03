
@extends('../templates.principal')

@section('title')
    Cargo
@endsection

@section('content')
    
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>CARGOS CADASTRADOS</h2>
    </div>

    <table class="table table-hover">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
            <th> Nome </th>
        </thead>

        <tbody>
        @foreach($cargos as $cargo)
            <tr onclick="location.href = '{{ route('cargo.edit', ['cargo' => $cargo->id]) }}'" style="cursor: pointer;">
                <td> {{ $cargo->nome }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection