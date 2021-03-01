@extends('templates.principal')

@section('title')
    Notificacao
@endsection

@section('content')
    @php
        $estoque = DB::table('estoques')->where('material_id', '=', $notificacao->material_id)->first();
    @endphp
    <h1 style="text-align: center"> Notificação </h1>
    <p style="text-align: center; font-size: large">O material
        <b>{{\App\Material::withTrashed()->find($notificacao->material_id)->nome}}</b>, de codigo
        <b>{{\App\Material::withTrashed()->find($notificacao->material_id)->codigo}}</b> acaba de atingir um estado critico!</p>
    <p style="text-align: center; font-size: medium"><b>Quantidade em Estoque: </b>{{$notificacao->material_quant}} <br>
        <b>Quantidade Minima: </b>{{\App\Material::withTrashed()->find($notificacao->material_id)->quantidade_minima}}</p>
    <center>{{date_format($notificacao->created_at,"d/m/Y H:i:s")}}</center>
@endsection

