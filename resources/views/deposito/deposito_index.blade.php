
@extends('../templates.principal')

@section('title')
    Depositos
@endsection

@section('content')

    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>DEPÓSITOS CADASTRADOS</h2>
    </div>

    <table class="table table-hover">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
             <tr>
                <th scope="col">Depósito</th>
                <th scope="col">Código</th>
            </tr>
        </thead>
        <tbody>

            @forelse($depositos as $deposito)
                <tr onclick="location.href = '{{ route('deposito.edit', $deposito->id) }}'" style="cursor: pointer;">
                    <td> {{ $deposito->nome }} </td>
                    <td> {{ $deposito->codigo }} </td>
                </tr>
            @empty
                <td colspan="2">Sem depósitos cadastrados ainda</td>
            @endempty

        </tbody>
    </table>

@endsection
