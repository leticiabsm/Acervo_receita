@extends('layouts.publica')

@section('content')
<div class="container">
  <h2>Novo Livro Publicado</h2>
  <a href="{{ route('livros_publicados.create') }}" class="btn btn-success mb-3">
  <i class="bi bi-plus-circle"></i> Novo Livro
</a>

<a href="{{ route('livros.download', $livro->id) }}" class="btn btn-primary">
    Download PDF
</a>

</div>
@endsection
