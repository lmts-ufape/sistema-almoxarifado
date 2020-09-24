<form method="POST" action="{{ route('material.store') }}">

    {{ csrf_field() }}

    <label>Nome:</label>
    <input type="text" name="nome">
    </br>

    <label>Código:</label>
    <input type="text" name="codigo">
    </br>

    <label>Quantidade mínima:</label>
    <input type="number" name="quantidade_minima">
    </br>

    <label>Imagem:</label>
    <input type="image" name="imagem_material">
    </br>

    <label>Descrição:</label>
    <input type="text" name="descricao">
    </br>

    <input type="submit" value="Cadastrar">
</form>
