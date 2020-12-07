@component('mail::message')

<h1>Alerta de Material em Estoque</h1>

<p>Olá {{$usuario->nome}} o material {{$material->nome}} de codigo: {{$material->codigo}}. Acabou de atingir um estado critico.</p>
@endcomponent
