@extends('templates.principal')

@section('title') Página Inicial @endsection

@section('content')
<div class="container" style="background-color: #1b1c42; text-align: center; width: auto; margin: -20px; padding: 200px 20px">
    <h1 style="color: #949494; align-items: center">BEM-VINDO(A) {{ Str::upper(Auth::user()->nome) }}!</h1>
</div>
@endsection
