<form action="{{ route('livros.store') }}" method="POST">
    @csrf
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" required>

    <label for="isbn">ISBN:</label>
    <input type="text" name="isbn" required>

    <button type="submit">Incluir Livro</button>

</form>