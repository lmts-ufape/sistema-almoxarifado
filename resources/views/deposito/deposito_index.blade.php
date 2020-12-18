
@extends('../templates.principal')

@section('title')
    Depositos
@endsection

@section('content')

    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>DEPÓSITOS CADASTRADOS</h2>
    </div>

    <table id="tableDepositos" class="table table-hover table-responsive-md">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
             <tr>
                <th class="text-left" scope="col" style="text-align: center">Depósito</th>
                <th scope="col" style="text-align: center">Código</th>
            </tr>
        </thead>
        <tbody>

            @forelse($depositos as $deposito)
                <tr onclick="location.href = '{{ route('deposito.edit', $deposito->id) }}'" style="cursor: pointer;">
                    <td class="text-left" style="text-align: center"> {{ $deposito->nome }} </td>
                    <td style="text-align: center"> {{ $deposito->codigo }} </td>
                </tr>
            @empty
                <td colspan="2">Sem depósitos cadastrados ainda</td>
            @endempty
        </tbody>
    </table>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="{{asset('js/deposito/index.js')}}"></script>
