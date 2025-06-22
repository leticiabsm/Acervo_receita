@extends('layouts.publica')

@section('content')
<div class="container">
  <h2>Livros Publicados</h2>
  <a href="{{ route('livros_publicados.create') }}" class="btn btn-success mb-3">Novo Livro</a>

  <input type="text" id="busca" class="form-control mb-3" placeholder="Buscar...">

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Título</th>
        <th>Editor</th>
        <th>ISBN</th>
        <th>Cozinheiro</th>
        <th>Degustador</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody id="tabelaLivros">
      @foreach($livros as $livro)
      <tr>
        <td>{{ $livro->titulo }}</td>
        <td>{{ $livro->editor }}</td>
        <td>{{ $livro->isbn }}</td>
        <td>{{ $livro->funcionario->nome }}</td>
        <td>{{ $livro->nota->degustador }}</td>
        <td>
          <a href="{{ route('livros_publicados.edit', $livro->id) }}" class="btn btn-primary btn-sm">
            <i class="bi bi-pencil"></i>
          </a>
          <form action="{{ route('livros_publicados.destroy', $livro->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script>
  document.getElementById('busca').addEventListener('keyup', function () {
    let termo = this.value.toLowerCase();
    document.querySelectorAll('#tabelaLivros tr').forEach(tr => {
      tr.style.display = tr.textContent.toLowerCase().includes(termo) ? '' : 'none';
    });
  });
</script>
@endsection
