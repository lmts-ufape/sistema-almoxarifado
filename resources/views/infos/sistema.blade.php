@extends('templates.templateLogin')
@section('title') Sistema @endsection
@section('content')
<div class="container" style="background: rgb(240, 238, 238); margin: 30px auto; padding: 40px; border-radius: 15px">
    <div class="container" style="background: rgb(240, 238, 238); ">
        <h1 style="color: #3E3767; font-weight: bold; margin-bottom:20px">Sobre o sistema</h1>
        <h2 style="color: #3E3767;font-weight: bold">O que é o sistema eletrônico de gestão de almoxarifados (SEGA)?</h2>
        <p style="color: #3E3767; text-align: justify">
            É uma aplicação web desenvolvida no âmbito da cooperação técnica UFAPE-LMTS / UPE com o objetivo de informatizar o gerenciamento de almoxarifados,
             auxiliando os responsáveis nas suas rotinas de trabalho,
             como controlar o estoque e atender demandas dos solicitantes por materiais etc.
        </p>
        <h2 style="color: #3E3767; font-weight: bold">Principais funcionalidades</h2>
        <ul style="color: #3E3767; text-align: justify">
            <li style="font-weight: bold">Administrador</li>
            <ul>
                <li style="font-weight: bold">Cadastrar e editar:</li>
                <ul>
                    <li>Usuários</li>
                    <li>Materiais</li>
                    <li>Depósitos</li>
                </ul>
                <li style="font-weight: bold">Consultar:</li>
                <ul>
                    <li>Estoque total de materiais</li>
                    <li>Materiais por depósito</li>
                    <li>Histórico de solicitações</li>
                </ul>
                <li style="font-weight: bold">Gerenciar estoque:</li>
                <ul>
                    <li>Entrada de material</li>
                    <li>Saída de material</li>
                    <li>Transferência de material entre depósitos</li>
                </ul>
                <li style="font-weight: bold">Gerenciar solicitações:</li>
                <ul>
                    <li>Analisar solicitação:</li>
                    <ul>
                        <li>Aprovar solicitação totalmente</li>
                        <li>Aprovar solicitação parcialmente</li>
                        <li>Negar solicitação</li>
                    </ul>
                    <li>Retirar pedido</li>
                    <ul>
                        <li>Entregar materiais</li>
                        <li>Cancelar solicitação</li>
                    </ul>
                </ul>
            </ul>
            <li style="font-weight: bold">Requerente</li>
            <ul>
                <li style="font-weight: bold">Editar:</li>
                <ul>
                    <li>Dados do próprio perfil</li>
                    <li>Senha</li>
                </ul>
                <li style="font-weight: bold">Fazer solicitação:</li>
                <ul>
                    <li>De um ou mais materiais</li>
                    <li>Para o próprio requerente buscar ou outra pessoa especificada</li>
                </ul>
                <li >Consultar histórico de solicitações:</li>
            </ul>
        </ul>
    </div>
</div>
@endsection
