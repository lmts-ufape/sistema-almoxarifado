@extends('templates.principal')

@section('title') Consultar Materiais @endsection

@section('content')
    <div style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>TODAS AS NOTIFICAÇÕES</h2>
    </div>

    <table id="tableNotificacoes" class="table table-hover table-responsive-md">
        <thead style="background-color: #151631; color: white; border-radius: 15px">
        <tr>
            <th class="align-middle" scope="col">Mensagem</th>
        </tr>
        </thead>
        <tbody>

        @forelse($notificacoes as $notificacao)
            @if(!empty($notificacoes))
            <tr onclick="location.href = '{{route('notificacao.show', ['notificacao_id' => $notificacao->id])}}'" style="cursor: pointer;">
                <td>{{ $notificacao->mensagem }}</td>
            </tr>
            @endif
        @empty
            <td colspan="5">Você ainda não possui notificações</td>
        @endempty

        </tbody>
    </table>
    {{ $notificacoes->links() }}
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="{{asset('js/material/todos_materiais.js')}}"></script>
