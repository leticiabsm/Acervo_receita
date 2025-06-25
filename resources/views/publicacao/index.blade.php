@extends('layouts.publica')

@section('content')
<div class="container mt-5">
  <h2 class="mb-4" style="font-weight: bold; color: #fff;">Adicionar Publicacao de Livro</h2>
  <div class="d-flex mb-3">
    <!--botao de incluir livro publicado-->
    <form class="flex-grow-1 me-2 d-flex" method="GET" action="{{ route('publicacao.index') }}">
      <input type="text" name="searchInput" class="form-control" placeholder="Pesquisar" value="{{ request('pesquisa') }}">
      <button type="submit" class="btn" style="background:transparent; border:none; margin-left:-40px;">
        <img src="{{ asset('img/icons/lupa.png') }}" alt="Pesquisar" style="width:22px; height:22px;">
      </button>
    </form>
    <a href="{{ route('publicacao.create') }}"
      class="btn d-flex align-items-center"
      style="background:#83CD71; border:3px solid #25BB00; color:#fff; font-weight:bold;">
      Incluir Publicação
      <img src="{{ asset('img/icons/user_plus_add.png') }}" alt="Incluir Publicacao" style="width:22px; height:22px;" class="ms-3">
    </a>
  </div>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Título</th>
        <th>Editor</th>
        <th>ISBN</th>
        <th>Cozinheiro</th>
        <th>Degustador</th>
        <th>Atividades</th>
      </tr>
    </thead>
    <tbody id="tabelaLivros">
      @foreach($livros as $livro)
      <tr>
        <td>
          <a href="{{ route('publicacao.visualizar', $livro->id) }}" style="color:#FFA800; font-weight:bold; text-decoration:none;">
            {{ $livro->titulo ?? '-' }}
          </a>
        </td>
        <td>{{ $livro->editor ?? '-' }}</td>
        <td>{{ $livro->isbn ?? '-' }}</td>
        <td>{{ $livro->funcionario->nome ?? '-' }}</td>
        <td>{{ $livro->degustacao->degustador ?? '-' }}</td>
        <td>
          <a href="{{ route('publicacao.edit', $livro->id) }}" class="btn btn-primary btn-sm">
            <i class="bi bi-pencil"></i>
          </a>
          <form action="{{ route('publicacao.destroy', $livro->id) }}" method="POST" style="display:inline;">
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
  // Corrigido para evitar erro caso não exista o elemento 'busca'
  document.addEventListener('DOMContentLoaded', function() {
    const busca = document.getElementById('busca');
    if (busca) {
      busca.addEventListener('keyup', function() {
        let termo = this.value.toLowerCase();
        document.querySelectorAll('#tabelaLivros tr').forEach(tr => {
          tr.style.display = tr.textContent.toLowerCase().includes(termo) ? '' : 'none';
        });
      });
    }
  });
</script>
@endsection