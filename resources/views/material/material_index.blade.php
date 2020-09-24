<div>
    <h1>LISTA DE MATERIAIS</h1>
    <a href="{{ route('material.create') }}">Cadastrar novo material</a>
    <ul>
        @foreach($materials as $material)
            <li> {{ $material->imagem }}| {{ $material->nome }} | {{ $material->codigo }} | {{ $material->quantidade_minima }}</li>
        @endforeach
    </ul>
<div>
